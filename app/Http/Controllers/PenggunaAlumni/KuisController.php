<?php

namespace App\Http\Controllers\PenggunaAlumni;

use App\Http\Controllers\Controller;
use App\Models\KuisPenggunaAlumni;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    public function store(Request $request, $id)
    {
        return DB::transaction(function() use ($request, $id) {
            $requestData = $request->all();

            $jsonData = [];
            
            foreach ($requestData as $key => $value) {
                $jsonData[$key] = $value;
            }

            $jsonEncodeData = json_encode($jsonData);
            
            KuisPenggunaAlumni::create([
                "riwayat_pekerjaan_id" => $id,
                "text" => $jsonEncodeData,
                "tanggal_isi_kuis" => date("Y-m-d")
            ]);

            RiwayatPekerjaan::where("id", $id)->update([
                "is_kuisioner" => "1"
            ]);

            return redirect("/success");
        });
    }

    public function success()
    {
        return DB::transaction(function() {
            return view("pages.pengguna.kuisioner.v_success");
        });
    }
}
