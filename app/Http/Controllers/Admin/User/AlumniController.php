<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Prodi;
use App\Models\RiwayatPekerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlumniController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $data["prodi"] = Prodi::orderBy("created_at", "DESC")->get();
            $data["alumni"] = Alumni::orderBy("created_at", "DESC")->get();
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
            
            return view("pages.admin.alumni.v_index", $data);
        });
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "max" => "Kolom :attribute Maximal Harus :max Digit"
        ];

        $this->validate($request, [
            "nama" => "required",
            "email" => "required",
            "nomor_hp" => "required|min:12|max:15",
            "jenis_kelamin" => "required",
            "prodi_id" => "required",
            "nim" => "required",
            "bulan_masuk" => "required",
            "bulan_lulus" => "required",
            "tahun_masuk" => "required",
            "tahun_lulus" => "required",
            "foto" => "required",
            "alamat" => "required",
            "tanggal_lahir" => "required"
        ], $messages);

        return DB::transaction(function() use($request) {
            
            $cek = Alumni::where("nim", $request->nim)->count();

            if ($cek > 0) {
                return back()->with("error", "NIM Sudah Ada")->withInput();
            }

            if ($request->file("foto")) {
                $foto = $request->file("foto")->store("alumni");
            }
            
            $user = User::create([
                "nama" => $request->nama,
                "username" => Str::slug($request->nim),
                "email" => $request->email,
                "password" => bcrypt($request->tanggal_lahir),
                "nomor_hp" => $request->nomor_hp,
                "akses" => "alumni"
            ]);
            
            Alumni::create([
                "user_id" => $user["id"],
                "nim" => $request->nim,
                "prodi_id" => $request->prodi_id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "bulan_masuk" => $request->bulan_masuk,
                "tahun_masuk" => $request->tahun_masuk,
                "bulan_lulus" => $request->bulan_lulus,
                "tahun_lulus" => $request->tahun_lulus,
                "foto" => $foto,
                "alamat" => $request->alamat,
                "tanggal_lahir" => $request->tanggal_lahir
            ]);
            
            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function show($id)
    {
        return DB::transaction(function() use ($id) {
            $data["detail"] = Alumni::where("id", $id)->first();
            $data["riwayat"] = RiwayatPekerjaan::where("alumni_id", $id)->get();

            return view("pages.admin.alumni.v_detail", $data);
        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "max" => "Kolom :attribute Maximal Harus :max Digit"
        ];

        $this->validate($request, [
            "nama" => "required",
            "email" => "required",
            "nomor_hp" => "required|min:12",
            "jenis_kelamin" => "required",
            "prodi_id" => "required",
            "nim" => "required",
            "alamat" => "required",
            "tanggal_lahir" => "required"
        ], $messages);

        return DB::transaction(function () use($request, $id) {

            if ($request->file("foto")) {
                if ($request->foto_lama) {
                    Storage::delete($request->foto_lama);
                }
                
                $foto = $request->file("foto")->store("alumni");
            } else {
                $foto = $request->foto_lama;
            }
            Alumni::where("id", $id)->update([
                "nim" => $request->nim,
                "prodi_id" => $request->prodi_id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "foto" => $foto,
                "alamat" => $request->alamat,
                "tanggal_lahir" => $request->tanggal_lahir
            ]);
            
            $alumni = Alumni::where("id", $id)->first();
            
            $user = User::where("id", $alumni["user_id"])->update([
                "nama" => $request->nama,
                "username" => Str::slug($request->nama),
                "email" => $request->email,
                "password" => bcrypt($request->tanggal_lahir),
                "nomor_hp" => $request->nomor_hp
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $alumni = Alumni::where("id", $id)->first();
            
            Storage::delete($alumni["foto"]);
            
            User::where("id", $alumni["user_id"])->delete();
            
            $alumni->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
