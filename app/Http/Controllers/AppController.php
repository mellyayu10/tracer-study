<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\InformasiLogin;
use App\Models\Instansi;
use App\Models\KategoriKuisioner;
use App\Models\RekomendasiAlumni;
use App\Models\RiwayatPekerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function template()
    {
        return view("pages.layouts.main");
    }
    
    public function dashboard_admin()
    {
        $data["data_alumni"] = Alumni::count();
        $data["data_administrator"] = User::where("akses", "admin")->count();
        $data["rekomendasi_alumni"] = RekomendasiAlumni::where("status", 1)->count();
        $data["informasi_login"] = InformasiLogin::where("user_id", Auth::user()->id)->paginate(5);
        
        return view("pages.admin.v_dashboard", $data);
    }
    
    public function dashboard_alumni()
    {
        $data["riwayat"] = RiwayatPekerjaan::where("alumni_id", Auth::user()->alumni->id)->get();
        $data["informasi_login"] = InformasiLogin::where("user_id", Auth::user()->id)->get();
        $data["kategori_kuisioner"] = KategoriKuisioner::where("status", 1)->where("tipe_kuisioner", 1)->get();
        $data["instansi"] = Instansi::orderBy("nama_instansi", "ASC")->get();
        $data['bulan'] = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $data["instansiAutoComplete"] = Instansi::orderBy('nama_instansi','ASC')->pluck('nama_instansi');
        
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json");
        
        $data["provinsi"] = $response->json();
        
        return view("pages.alumni.v_dashboard", $data);
    }
    
    public function informasi_login_all()
    {
        $data["informasi_login"] = InformasiLogin::orderBy("tanggal", "DESC")->get();
        
        return view("pages.admin.informasi_login.v_index", $data);
    }
    
    public function update_profil(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Wajib Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "max" => "Kolom :attribut Maximal Harus :max Digit"
        ];
        
        $this->validate($request, [
            "nomor_hp" => "required",
            "alamat" => "required",
            "tanggal_lahir" => "required"
        ], $messages);
        
        $res_provinsi = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json");
        
        $provinsi = $res_provinsi->json();
        
        foreach ($provinsi as $p) {
            if ($p["id"] == $request->provinsi) {
                $provinsi = $p["name"];
                $id = $p["id"];
            }
        }
        
        if (empty($request->kota_kab) && empty($request->kecamatan) && empty($request->kelurahan)) {
            
        } else {
            
            $res_kota_kab = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/".$id.".json");
            
            $kota_kab = $res_kota_kab->json();
            
            foreach ($kota_kab as $kota) {
                if ($kota['id'] == $request->kota_kab) {
                    $kota_kab = $kota["name"];
                    $id_kota_kab = $kota["id"];
                }
            }
            
            $res_kecamatan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/".$id_kota_kab.".json");
            
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
        }
        
        if ($request->file("foto")) {
            if ($request->foto_lama) {
                Storage::delete($request->foto_lama);
            }
            
            $foto = $request->file("foto")->store("alumni");
        } else {
            $foto = $request->foto_lama;
        }
        
        User::where("id", Auth::user()->id)->update([
            "nomor_hp" => $request->nomor_hp,
            "password" => bcrypt($request->tanggal_lahir)
        ]);
        
        Alumni::where("user_id", Auth::user()->id)->update([
            "jenis_kelamin" => $request->jenis_kelamin,
            "foto" => $foto,
            "provinsi" => empty($request->provinsi) ? Auth::user()->alumni->provinsi : $provinsi,
            "kota_kab" => empty($request->kota_kab) ? Auth::user()->alumni->kota_kab : $kota_kab,
            "kecamatan" => empty($request->kecamatan) ? Auth::user()->alumni->kecamatan : $kcmtn,
            "kelurahan" => empty($request->kelurahan) ? Auth::user()->alumni->kelurahan : $klrhn,
            "tanggal_lahir" => $request->tanggal_lahir,
            "alamat" => $request->alamat
        ]);
        
        return back();
    }
    
    public function link($id)
    {
        return DB::transaction(function() use ($id) {
            $search = RiwayatPekerjaan::where("id", $id)->first();
            
            return redirect()->away('https://api.whatsapp.com/send?phone='. $search["nomor_hp"] .'/&text=Hallo, ' . "*"  . $search["pengguna_alumni"] . "* Ada Kuisioner Dari *" . $search["alumni"]["user"]["nama"] . "*. Anda Diminta Untuk Mengisi Terkait Kepuasan Tentang Kinerja *" . $search["alumni"]["user"]["nama"] . "* %20 Untuk Link Kuisioner : " . url('/pengguna_alumni/'.$search["id"]) );
        });
    }
    
    public function kuis_survey($id)
    {
        return DB::transaction(function() use ($id) {
            $data["detail"] = RiwayatPekerjaan::where("id", $id)->first();
            
            if ($data["detail"]["is_kuisioner"] == 1) {
                return redirect("/success");
            } else {
                $data["kuis_user"] = KategoriKuisioner::where("status", 1)->where("tipe_kuisioner", 2)->get();
                
                return view("pages.pengguna.kuisioner.v_index", $data);
            }
            
        });
    }
    
    public function kelola_pekerjaan()
    {
        return DB::transaction(function() {
            $data["alumni"] = Alumni::get();
            $data["rekomendasi"] = RekomendasiAlumni::get();
            
            return view("pages.admin.kelola_riwayat_pekerjaan.v_index", $data);
        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "numeric" => "Kolom :attribute Harus Bersifat Angka",
            "min" => "Kolom :attribute Minimal Harus :min Digit"
        ];
        
        $this->validate($request, [
            "alumni_id" => "required",
            "nomer_hp" => "required|numeric|min:12"
        ], $messages);
        
        return DB::transaction(function() use ($request, $id) {
            RekomendasiAlumni::where("id", $id)->update([
                "status" => "1"
            ]);
            
            $cek = Alumni::where("id", $request["alumni_id"])->first();
            
            User::where("id", $cek["user_id"])->update([
                "nomor_hp" => $request["nomer_hp"]
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function ubah_status($id)
    {
        return DB::transaction(function() use ($id) {
            RiwayatPekerjaan::where('id', $id)->update([
                "status" => "1"
            ]);
            
            return back()->with("message", "Data Berhasil di Konfirmasi");
        });
    }

    public function ditolak($id)
    {
        return DB::transaction(function () use ($id) {
            RekomendasiAlumni::where("id", $id)->update([
                "status" => '2'
            ]);

            return back()->with("message", "Data Berhasil di Konfirmasi");
        });
    }

    public function diterima($id)
    {
        return DB::transaction(function () use ($id) {
            RekomendasiAlumni::where("id", $id)->update([
                "status" => '1'
            ]);

            return back()->with("message", "Data Berhasil di Konfirmasi");
        });
    }
}
