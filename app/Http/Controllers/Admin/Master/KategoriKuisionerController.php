<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DetailKategoriKuisioner;
use App\Models\Kategori;
use App\Models\KategoriKuisioner;
use App\Models\PointPilihanGanda;
use App\Models\PointPilihanTunggal;
use App\Models\SettingKategoriKuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriKuisionerController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $data["kategori_kuisioner"] = KategoriKuisioner::get();
            
            return view("pages.admin.kategori_kuisioner.v_index", $data);
        });
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_kategori_kuisioner" => "required",
            "tipe_kuisioner" => "required"
        ], $messages);

        return DB::transaction(function() use ($request) {
            
            KategoriKuisioner::create([
                "nama_kategori_kuisioner" => $request["nama_kategori_kuisioner"],
                "slug" => Str::slug($request["nama_kategori_kuisioner"]),
                "tipe_kuisioner" => $request["tipe_kuisioner"]
            ]);
            
            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function show($id)
    {
        return DB::transaction(function() use($id) {
            
            $data["detail"] = KategoriKuisioner::where("id", $id)->first();

            if ($data["detail"]["status"] == 0) {
                return redirect("/admin/kategori_kuisioner")->with("message_error", "Status Belum Diaktifkan");
            } else {
                $data["setting"] = SettingKategoriKuisioner::where("kategori_kuisioner_id", $id)->get();
                $data["kategori"] = Kategori::orderBy("id", "ASC")->get();
    
                $data["kategori_isian"] = DetailKategoriKuisioner::where("kategori_kuisioner_id", $id)->where("tipe_soal", 1)->get();
    
                $data["pilihan_ganda"] = DetailKategoriKuisioner::where("kategori_kuisioner_id", $id)->where("tipe_soal", 2)->get();
    
                $data["pilihan_tunggal"] = DetailKategoriKuisioner::where("kategori_kuisioner_id", $id)->where("tipe_soal", 3)->get();
    
                return view("pages.admin.kategori_kuisioner.v_detail", $data);
            }

        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
        ];

        $this->validate($request, [
            "nama_kategori_kuisioner" => "required",
            "tipe_kuisioner" => "required"
        ], $messages);

        return DB::transaction(function() use ($request, $id) {
            KategoriKuisioner::where("id", $id)->update([
                "nama_kategori_kuisioner" => $request->nama_kategori_kuisioner,
                "slug" => Str::slug($request["nama_kategori_kuisioner"]),
                "tipe_kuisioner" => $request["tipe_kuisioner"]
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            KategoriKuisioner::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }

    public function create_isian(Request $request, $id)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $message);

        return DB::transaction(function() use ($request, $id) {
            DetailKategoriKuisioner::create([
                "kategori_kuisioner_id" => $id,
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "tipe_soal" => 1,
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function put_detail_kategori_kuisioner(Request $request, $id, $id_detail_kuisioner)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $messages);

        return DB::transaction(function() use ($request, $id_detail_kuisioner) {
            DetailKategoriKuisioner::where("id", $id_detail_kuisioner)->update([
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Simpan");
        });
    }

    public function create_pilihan_ganda(Request $request, $id) 
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $message);

        return DB::transaction(function() use ($request, $id) {
            DetailKategoriKuisioner::create([
                "kategori_kuisioner_id" => $id,
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "tipe_soal" => 2,
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function put_detail_kategori_kuisioner_pilihan_ganda(Request $request, $id_detail_kuisioner, $id_pilihan_tunggal)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $message);

        return DB::transaction(function() use ($request, $id_pilihan_tunggal) {
            DetailKategoriKuisioner::where("id", $id_pilihan_tunggal)->update([
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Simpan");
        });
    }

    public function create_pilihan_tunggal(Request $request, $id_detail_kuisioner)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $message);

        return DB::transaction(function() use ($request, $id_detail_kuisioner) {
            DetailKategoriKuisioner::create([
                "kategori_kuisioner_id" => $id_detail_kuisioner,
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "tipe_soal" => 3,
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function put_detail_kategori_kuisioner_pilihan_tunggal(Request $request, $id_detail_kuisioner, $id_pilihan_tunggal)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_soal" => "required",
            "is_kuisioner" => "required"
        ], $message);
        
        return DB::transaction(function() use ($request, $id_pilihan_tunggal) {
            DetailKategoriKuisioner::where("id", $id_pilihan_tunggal)->update([
                "nama_soal" => $request["nama_soal"],
                "slug" => Str::slug($request["nama_soal"]),
                "is_kuisioner" => $request["is_kuisioner"]
            ]);

            return back()->with("message", "Data Berhasil di Simpan");
        });
    }

    public function detail_kategori_kuisioner_pilihan_ganda($id, $id_detail_kuisioner)
    {
        return DB::transaction(function() use ($id_detail_kuisioner) {
            $data["detail"] = DetailKategoriKuisioner::where("id", $id_detail_kuisioner)->first();

            $data["point_pilihan_ganda"] = PointPilihanGanda::where("detail_kategori_kuisioner_id", $id_detail_kuisioner)->get();

            return view("pages.admin.kategori_kuisioner.v_detail_kuisioner_pilihan_ganda", $data);
        });
    }

    public function detail_kategori_kuisioner_pilihan_tunggal($id, $id_detail_kuisioner)
    {
        return DB::transaction(function() use ($id_detail_kuisioner) {
            $data["detail"] = DetailKategoriKuisioner::where("id", $id_detail_kuisioner)->first();

            $data["point_pilihan_tunggal"] = PointPilihanTunggal::where("detail_kategori_kuisioner_id", $id_detail_kuisioner)->get();

            return view("pages.admin.kategori_kuisioner.v_detail_kuisioner_pilihan_tunggal", $data);
        });
    }

    public function aktifkan($id)
    {
        return DB::transaction(function() use ($id) {
            KategoriKuisioner::where("id", $id)->update([
                "status" => "1"
            ]);

            return back()->with("message", "Data Berhasil di Aktifkan");
        });
    }

    public function non_aktifkan($id)
    {
        return DB::transaction(function() use ($id) {
            KategoriKuisioner::where("id", $id)->update([
                "status" => "0"
            ]);

            return back()->with("message", "Data Berhasil di Non - Aktifkan");
        });
    }

    public function delete_isian($id)
    {
        return DB::transaction(function() use ($id) {
            DetailKategoriKuisioner::where("id", $id)->delete();

            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
    
    public function delete_pilihan_tunggal($id)
    {
        return DB::transaction(function() use ($id) {
            DetailKategoriKuisioner::where("id", $id)->delete();

            return back()->with("message", "Data Berhasil di Hapus");
        });
    }

    public function delete_pilihan_ganda($id)
    {
        return DB::transaction(function() use ($id) {
            DetailKategoriKuisioner::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
