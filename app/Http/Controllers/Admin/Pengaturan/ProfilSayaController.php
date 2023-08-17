<?php

namespace App\Http\Controllers\Admin\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilSayaController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            return view("pages.admin.pengaturan.profil_saya.v_index");
        });
    }
    
    public function update(Request $request)
    {
        return DB::transaction(function() use ($request) {
            User::where("id", Auth::user()->id)->update([
                "nama" => $request["nama"],
                "email" => $request["email"],
                "nomor_hp" => $request["nomor_hp"], 
            ]);
            
            return back()->with("message", "Berhasil, Data Anda Berhasil di Ubah");
        });
    }
}
