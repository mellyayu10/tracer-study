<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class InstansiController extends Controller
{
    public function index()
    {
        $data["instansi"] = Instansi::get();
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json");
        
        $data["provinsi"] = $response->json();
        
        return view("pages.admin.instansi.v_index", $data);
    }
    
    public function store(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            "nama_instansi" => "required",
            "provinsi" => "required",
            "kota_kab" => "required",
            "kecamatan" => "required",
            "kelurahan" => "required"
        ], $message);
        
        return DB::transaction(function() use ($request) {
            $res_provinsi = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json");
                
            $provinsi = $res_provinsi->json();
            
            foreach ($provinsi as $p) {
                if ($p["id"] == $request->provinsi) {
                    $provinsi = $p["name"];
                    $id = $p["id"];
                }
            }
            
            $res_kota_kab = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/".$id.".json");
            
            $kota_kab = $res_kota_kab->json();
            
            foreach ($kota_kab as $kota) {
                if ($kota["id"] == $request->kota_kab) {
                    $kota_kabupaten = $kota["name"];
                    $id_kota_kabupaten = $kota["id"];
                }
            }
            
            $res_kecamatan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/".$id_kota_kabupaten.".json");
            
            
            $kecamatan = $res_kecamatan->json();
            
            foreach ($kecamatan as $kec) {
                if ($kec['id'] == $request->kecamatan) {
                    $kcmtn = $kec["name"];
                    $id_kecamatan = $kec["id"];
                }
            }
            
            $res_kelurahan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/".$id_kecamatan.".json");
            
            $kelurahan = $res_kelurahan->json();
            
            foreach ($kelurahan as $kel) {
                if ($kel['id'] == $request->kelurahan) {
                    $klrhn = $kel["name"];
                }
            }

            Instansi::create([
                "nama_instansi" => $request->nama_instansi,
                "alamat" => $request->alamat,
                "provinsi" => $provinsi,
                "kota_kab" => $kota_kabupaten,
                "kecamatan" => $kcmtn,
                "kelurahan" => $klrhn,
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }

    public function show($id)
    {
        return DB::transaction(function() use ($id) {
            $data["instansi"] = Instansi::where("id", $id)->first();
            $data["detail"] = RiwayatPekerjaan::where("nama_instansi", $data["instansi"]["nama_instansi"])->get();

            return view("pages.admin.instansi.v_detail", $data);
        });
    }

    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            'nama_instansi' => "required",
            'provinsi' => "required",
            'kota_kab' => "required",
            'kecamatan' => "required",
            'kelurahan' => "required",
        ], $messages);

        $data = [
            'nama_instansi' => $request->nama_instansi,
            'provinsi' => $request->provinsi,
            'kota_kab' => $request->kota_kab,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
        ];

        return DB::transaction(function() use ($data, $id) {
            Instansi::findOrFail($id)->update($data);

            return back()->with("message", "Data Berhasil di Hapus");
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            Instansi::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }

    public function detailInstansi(Request $request)
    {
        $instansi = Instansi::where('nama_instansi',$request->nama_instansi)->first();
        return response()->json($instansi);
    }

    public function dataAutoComplete()
    {
        $instansi = Instansi::orderBy('nama_instansi','ASC')->pluck('nama_instansi');
        return response()->json($instansi);
    }
}
