<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\InformasiLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function welcome()
    {
        return view("pages.autentikasi.v_welcome");
    }

    public function login(Request $request)
    {
        if ($request["user"] == "admin") {
            return view("pages.autentikasi.v_login_admin");
        } else if ($request["user"] == "alumni") {
            $data["alumni"] = Alumni::get();
    
            return view("pages.autentikasi.v_login_alumni", $data);
        }
    }
    
    public function post_login(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal :min digit"
        ];
        
        $this->validate($request, [
            "username" => "required",
            "password" => "required|min:8"
        ], $messages);

        return DB::transaction(function() use ($request) {
            $cek = User::where("username", $request->username)->first();
            
            if ($cek) {
                if (Hash::check($request->password, $cek->password)) {
                    if (Auth::attempt(["username" => $request->username, "password" => $request->password])) {
                        $request->session()->regenerate();
                        
                        InformasiLogin::create([
                            "user_id" => Auth::user()->id,
                            "tanggal" => date("YmdHis")
                        ]);
                        
                        if ($cek->akses == "admin") {
                            return redirect()->intended("/admin/dashboard")->with("success", "Berhasil Login");
                        } else if($cek->akses == "alumni") {
                            return redirect()->intended("/alumni/dashboard")->with("success", "Berhasil Login");
                        }
                    }
                } else {
                    return back()->withInput()->with("message", "Password Salah");
                }
            } else {
                return back()->withInput()->with("message", "Akun Tidak Ditemukan");
            }
        });
    }
    
    public function logout()
    {
        Auth::logout();
        
        return redirect("/");
    }
}
