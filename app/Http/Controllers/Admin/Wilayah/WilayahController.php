<?php

namespace App\Http\Controllers\Admin\Wilayah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    public function ambil_kota_kab(Request $request)
    {
        $id_provinsi = $request->provinsi;
        
        $res_kota_kab = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/".$id_provinsi.".json");

        $kota_kab = $res_kota_kab->json();

        foreach ($kota_kab as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }

    public function ambil_kecamatan(Request $request)
    {
        $id_kota_kab = $request->kota_kab;
        
        $res_kecamatan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/".$id_kota_kab.".json");

        $kecamatan = $res_kecamatan->json();

        foreach ($kecamatan as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }

    public function ambil_kelurahan(Request $request)
    {
        $id_kecamatan = $request->kecamatan;
        
        $res_kelurahan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/".$id_kecamatan.".json");

        $kelurahan = $res_kelurahan->json();

        foreach ($kelurahan as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }

    public function alumni_ambil_kota_kab(Request $request)
    {
        $id_pronvisi = $request->provinsi;
        
        $res_kota_kab = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/".$id_pronvisi.".json");

        $kota_kab = $res_kota_kab->json();

        foreach ($kota_kab as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }

    public function alumni_ambil_kecamatan(Request $request)
    {
        $id_kota_kab = $request->kota_kab;
        
        $res_kecamatan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/".$id_kota_kab.".json");

        $kecamatan = $res_kecamatan->json();

        foreach ($kecamatan as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }

    public function alumni_ambil_kelurahan(Request $request)
    {
        $id_kecamatan = $request->kecamatan;
        
        $res_kelurahan = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/".$id_kecamatan.".json");

        $kelurahan = $res_kelurahan->json();

        foreach ($kelurahan as $data) {
            echo "<option value='".$data['id']."'>".$data['name']."</option>";
        }
    }
}
