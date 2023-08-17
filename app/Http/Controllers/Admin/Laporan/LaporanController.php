<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\DetailKategoriKuisioner;
use App\Models\KategoriKuisioner;
use App\Models\KuisPenggunaAlumni;
use App\Models\PointPilihanTunggal;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pekerjaan()
    {
        return DB::transaction(function() {
            $data["riwayat_pekerjaan"] = RiwayatPekerjaan::select("nama_instansi", "alamat_instansi")->distinct()->get();
            
            return view("pages.admin.laporan.riwayat_pekerjaan.v_index", $data);
        });
    }
    
    public function search_pekerjaan(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"    
        ];
        
        $this->validate($request, [
            "nama_instansi" => "required",
            "tahun" => "required",
        ], $message);
        
        return DB::transaction(function() use ($request) {
            
            $tahun = $request->tahun;
            
            $search = RiwayatPekerjaan::where("nama_instansi", $request->nama_instansi)->whereYear("periode_kerja_mulai", $tahun)->get();
            
            if ($search->isEmpty()) {
                return back()->withInput()->with("message_error", "Tidak Ada Hasil");
            } else {
                return back()->withInput()->with("search", $search)->with("message", "Data Ditemukan");
            }
        });
    }
    
    public function download_pekerjaan(Request $request)
    {
        return DB::transaction(function() use($request) {
            $sessionData = json_decode($request["session_data"], true);

            $pdf = PDF::loadView("pages.admin.laporan.riwayat_pekerjaan.v_download", ["data" => $sessionData])->setPaper("a3");
            
            return $pdf->download("Data-Pekerjaan-Alumni.pdf");
        });
    }
    
    public function kuisioner_pengguna_alumni()
    {
        return DB::transaction(function() {
            
            $kategoriKuisoner = KategoriKuisioner::where("tipe_kuisioner", 2)
                ->pluck("id")
                ->toArray();

            $data["detail"] = DetailKategoriKuisioner::whereIn("kategori_kuisioner_id", $kategoriKuisoner)->where("tipe_soal", 3)
            ->get();

            return view("pages.admin.laporan.kuis.v_index", $data);
        });
    }

    public function child_options(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $cetak = $request["point"];
            $point = PointPilihanTunggal::where("detail_kategori_kuisioner_id", $cetak)->get();

            return response()->json($point);
        });
    }

    public function post_kuisioner_pengguna_alumni(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "point" => "required",
            "sub_point" => "required",
        ], $messages);

        return DB::transaction(function() use ($request) {
            $a = $request["slug_input"];
            $b = $request["sub_point"];
            $c = $a . "_" . $b;

            $dataArray = KuisPenggunaAlumni::all();

            $results = [];
            foreach ($dataArray as $key) {
                $data = json_decode($key->text, true);

                $data["pekerjaan"] = $key["riwayat_pekerjaan"];

                if (isset($data[$c])) {
                    $results[] = $data;
                } else {
                    $results[] = "Data tidak ditemukan";
                }
            }

            if (count($results) > 0) {
                return back()->withInput()->with(["slug" => $c, "results" => $results]);
            } else {
                return back();
            }
        });
    }
}
