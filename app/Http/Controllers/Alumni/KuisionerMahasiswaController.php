<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\KategoriKuisioner;
use App\Models\KuisionerMahasiswa;
use App\Models\KuisMahasiswa;
use App\Models\LangkahPekerjaan;
use App\Models\Pekerjaan;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KuisionerMahasiswaController extends Controller
{
    public function index()
    {
        $data["kuisioner"] = KuisMahasiswa::where("alumni_id", Auth::user()->alumni->id)->orderBy("id", "ASC")->get();
        
        return view("pages.alumni.kuisioner.v_index", $data);
    }
    
    public function create($id)
    {
        return DB::transaction(function() use ($id) {
            $data["id"] = $id;
            $data["kategori_kuisioner"] = KategoriKuisioner::where("status", 1)->where("tipe_kuisioner", 1)->get();
            
            return view("pages.alumni.kuisioner.v_create", $data);
        });
    }
    
    public function store(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $rules = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, $key) === 0) {
                $rules[$key] = "required";
            }
        }

        $this->validate($request, $rules, $messages);

        return DB::transaction(function() use ($request, $id) {
            $requestData = $request->all();

            $jsonData = [];
            
            foreach ($requestData as $key => $value) {
                $jsonData[$key] = $value;
            }

            $jsonEncodeData = json_encode($jsonData);
            
            KuisMahasiswa::create([
                "alumni_id" => Auth::user()->alumni->id,
                "text" => $jsonEncodeData,
                "tanggal_isi_kuis" => date("Y-m-d"),
                "pekerjaan_id" => $id
            ]);
            
            return redirect("/alumni/dashboard")->with("message", "Data Berhasil di Tambahkan");
        });
    }

    public function store_belum(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $rules = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, $key) === 0) {
                $rules[$key] = "required";
            }
        }

        $this->validate($request, $rules, $messages);

        return DB::transaction(function() use ($request) {
            $requestData = $request->all();

            $jsonData = [];
            
            foreach ($requestData as $key => $value) {
                $jsonData[$key] = $value;
            }

            $jsonEncodeData = json_encode($jsonData);
            
            KuisMahasiswa::create([
                "alumni_id" => Auth::user()->alumni->id,
                "text" => $jsonEncodeData,
                "tanggal_isi_kuis" => date("Y-m-d"),
            ]);
            
            return redirect("/alumni/dashboard")->with("message", "Data Berhasil di Tambahkan");
        });
    }
    
    public function show($id)
    {
        return DB::transaction(function() use($id) {
            $data["kuisioner"] = KuisMahasiswa::where("id", $id)->first();
            
            return view("pages.alumni.kuisioner.v_detail", $data);
        });
    }
}
