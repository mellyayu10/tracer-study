<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\KuisionerMahasiswa;
use App\Models\KuisMahasiswa;
use App\Models\RekomendasiAlumni;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekomendasiTempatController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data["rekomendasi"] = RekomendasiAlumni::where("alumni_id", Auth::user()->alumni->id)->get();

            return view("pages.alumni.rekomendasi.v_index", $data);
        });
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "numeric" => "Kolom :attribute Harus Berisikan Angka",
            "min" => "Kolom :attribute Minimal Harus :min Digit"
        ];

        $this->validate($request, [
            "nama" => "required",
            "nomer_hp" => "required|numeric|min:12"
        ], $messages);

        return DB::transaction(function() use ($request) {
            RekomendasiAlumni::create([
                "alumni_id" => Auth::user()->alumni->id,
                "nama" => $request["nama"],
                "nomer_hp" => $request["nomer_hp"]
            ]);

            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }
    
    public function show($slug)
    {
        return DB::transaction(function() use ($slug) {
            $data["detail"] = RiwayatPekerjaan::where("id", $slug)->first();
            $data["data_rekomendasi"] = RiwayatPekerjaan::where("id", $slug)->get();
            
            return view("pages.alumni.rekomendasi.v_detail", $data); 
        });
    }
}
