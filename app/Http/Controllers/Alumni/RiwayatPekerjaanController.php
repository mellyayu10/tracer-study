<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class RiwayatPekerjaanController extends Controller
{
    public function store(Request $request)
    {
        return DB::transaction(function() use($request) {
            
            if ($request->cari_instansi==0) {
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
                    "alamat" => $request->alamat_instansi,
                    "provinsi" => $provinsi,
                    "kota_kab" => $kota_kabupaten,
                    "kecamatan" => $kcmtn,
                    "kelurahan" => $klrhn,
                ]);
            } else if ($request->cari_instansi==1) {
                $cek = Instansi::where("id", $request->database_instansi)->first();
                
                $instansi = $cek["nama_instansi"];
                $alamat = $cek["alamat"];
            }
            
            RiwayatPekerjaan::create([
                "id" => Uuid::uuid4()->getHex(),
                "alumni_id" => Auth::user()->alumni->id,
                "nama_instansi" => $request->nama_instansi ? $request->nama_instansi : $instansi,
                "alamat_instansi" => $request->alamat_instansi ? $request->alamat_instansi : $alamat,
                "skala" => $request->skala,
                "profesi" => $request->profesi,
                "penghasilan_tiap_bulan" => $request->penghasilan_tiap_bulan,
                "periode_bulan_mulai" => $request->periode_bulan_mulai,
                "periode_bulan_akhir" => $request->periode_bulan_akhir,
                "periode_kerja_mulai" => $request->periode_kerja_mulai,
                "periode_kerja_akhir" => $request->periode_kerja_akhir,
                "pengguna_alumni" => $request->pengguna_alumni,
                "divisi" => $request->divisi,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "provinsi" => ($request->cari_instansi==0) ? $provinsi : $cek["provinsi"],
                "kota_kab" => ($request->cari_instansi==0) ? $kota_kabupaten : $cek["kota_kab"],
                "kecamatan" => ($request->cari_instansi==0) ? $kcmtn : $cek["kecamatan"],
                "kelurahan" => ($request->cari_instansi==0) ? $klrhn : $cek["kelurahan"],
                "status" => 0
            ]);
            
            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            "nama_instansi" => "required",
            "skala" => "required",
            "profesi" => "required",
            "penghasilan_tiap_bulan" => "required",
            "periode_bulan_mulai" => "required",
            "periode_bulan_akhir" => "required",
            "periode_kerja_mulai" => "required",
            "periode_kerja_akhir" => "required",
            "alamat_instansi" => "required",
            "pengguna_alumni" => "required",
            "email" => "required",
            "divisi" => "required",
            "nomor_hp" => "required",
        ], $messages);
        
        return DB::transaction(function () use ($request, $id) {
            RiwayatPekerjaan::where("id", $id)->update([
                "nama_instansi" => $request->nama_instansi,
                "alamat_instansi" => $request->alamat_instansi,
                "skala" => $request->skala,
                "profesi" => $request->profesi,
                "penghasilan_tiap_bulan" => $request->penghasilan_tiap_bulan,
                "periode_bulan_mulai" => $request->periode_bulan_mulai,
                "periode_bulan_akhir" => $request->periode_bulan_akhir,
                "periode_kerja_mulai" => $request->periode_kerja_mulai,
                "periode_kerja_akhir" => $request->periode_kerja_akhir,
                "pengguna_alumni" => $request->pengguna_alumni,
                "divisi" => $request->divisi,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            RiwayatPekerjaan::where('id', $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
