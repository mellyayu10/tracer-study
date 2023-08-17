<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DetailKategoriKuisioner;
use App\Models\KategoriKuisioner;
use App\Models\KuisMahasiswa;
use App\Models\User;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Str;

class KelolaKuisMahasiswaController extends Controller
{

    public function report()
    {
        $categories = KategoriKuisioner::orderBy('nama_kategori_kuisioner','ASC')->get();
        $mahasiswa = User::whereAkses('alumni')->orderBy('nama','ASC')->get();
        $data = [
            'categories' => $categories,
            'soal' => [],
            'mahasiswa' => $mahasiswa
        ];
        return view("pages.admin.kelola_kuis_mahasiswa.v_report", $data);
    }

    public function getSoal(Request $request)
    {
        $data['nama_soal'] = $request->nama_soal;
        $data["kategori"] = KategoriKuisioner::where("slug", $request->slug)->first();
        $data["detail"] = DetailKategoriKuisioner::where("kategori_kuisioner_id", $data["kategori"]["id"])->get();

        return view("pages.admin.kelola_kuis_mahasiswa._select_soal", $data);
    }

    public function index($slug)
    {
        $data["kategori"] = KategoriKuisioner::where("slug", $slug)->first();
        $data["detail"] = DetailKategoriKuisioner::where("kategori_kuisioner_id", $data["kategori"]["id"])->get();
        
        return view("pages.admin.kelola_kuis_mahasiswa.v_index", $data);
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            "nama_kategori_kuisioner" => "required",
        ], $messages);

        $soalArray = DetailKategoriKuisioner::where("kategori_kuisioner_id", $request->nama_kategori_kuisioner)->pluck('slug')->toArray();
        
        return DB::transaction(function() use ($request,$soalArray) {
            $nama_kategori_kuisioner = $request["nama_kategori_kuisioner"];
            $nama_mahasiswa = $request['nama_mahasiswa'];
            $kategori = KategoriKuisioner::find($nama_kategori_kuisioner);
            $dataArray = KuisMahasiswa::when($nama_mahasiswa,function($q)use($nama_mahasiswa){
                $q->where('alumni_id',$nama_mahasiswa);
            })->orderBy('tanggal_isi_kuis','DESC')->get();
            
            $results = [];
            foreach ($dataArray as $key) {
                $data = json_decode($key->text, true);
                $intersectedArray = array_intersect_key($data, array_flip($soalArray));
                $mahasiswa = Alumni::find($key["alumni_id"]);
                $results[] = [
                    'nama_mahasiswa' => $mahasiswa->user->nama ?? '-',
                    'soal' => $intersectedArray
                ];
            }
            if (count($results) > 0) {
                return back()->withInput()->with(["results" => $results,"nama_kategori_kuisioner"=>$request->nama_kategori_kuisioner,"nama_mahasiswa"=>$nama_mahasiswa,"kategori"=>$kategori]);
            } else {
                return back();
            }
            
        });
    }
    
    public function download(Request $request, $id)
    {
        $soalArray = DetailKategoriKuisioner::where("kategori_kuisioner_id", $id)->pluck('slug')->toArray();

        return DB::transaction(function() use ($request,$soalArray,$id) {
            $nama_kategori_kuisioner = $id;
            $kategori = KategoriKuisioner::find($id);
            $nama_mahasiswa = $request['nama_mahasiswa'];
            $dataArray = KuisMahasiswa::when($nama_mahasiswa,function($q)use($nama_mahasiswa){
                $q->where('alumni_id',$nama_mahasiswa);
            })->orderBy('tanggal_isi_kuis','DESC')->get();

            $results = [];
            foreach ($dataArray as $key) {
                $data = json_decode($key->text, true);
                $intersectedArray = array_intersect_key($data, array_flip($soalArray));
                $mahasiswa = Alumni::find($key["alumni_id"]);
                $results[] = [
                    'nama_mahasiswa' => $mahasiswa->user->nama ?? '-',
                    'soal' => $intersectedArray
                ];
            }
            
            if (count($results) > 0) {
                $pdf = PDF::loadView("pages.admin.kelola_kuis_mahasiswa.v_download", ["results" => $results, "slug" => $id,"kategori"=>$kategori])->setPaper("a3");

                return $pdf->download("Laporan-Kuisioner-Alumni.pdf");
            } else {
                return back();
            }
        });
    }
}
