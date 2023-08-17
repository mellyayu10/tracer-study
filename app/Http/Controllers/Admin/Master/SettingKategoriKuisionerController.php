<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\SettingKategoriKuisioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingKategoriKuisionerController extends Controller
{
    public function aktifkan(Request $request)
    {
        return DB::transaction(function() use ($request) {
            
            $cek = SettingKategoriKuisioner::where("kategori_kuisioner_id", $request->kategori_kuisioner_id)->first();

            if (empty($cek)) {
                SettingKategoriKuisioner::create([
                    "kategori_kuisioner_id" => $request->kategori_kuisioner_id,
                    "setting" => $request["setting"]
                ]);

                return back()->with("message", "Data Berhasil di Simpan");
            } else {
                SettingKategoriKuisioner::create([
                    "kategori_kuisioner_id" => $request->kategori_kuisioner_id,
                    "setting" => $request["setting"]
                ]);

                return back();
            }

        });
    }

    public function non_aktifkan(Request $request)
    {
        return DB::transaction(function() use ($request) {
            SettingKategoriKuisioner::where("id", $request->id)->delete();

            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
}
