<?php

namespace App\Http\Controllers\Public\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            return view("pages.public.ganti_password.v_ganti");
        });
    }

    public function update(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "confirmed" => "Kolom :attribute Harus Sama Dengan Password"
        ];

        $this->validate($request, [
            "password_baru" => "required|min:8",
            "konfirmasi_password" => "required|min:8"
        ], $messages);

        return DB::transaction(function() use ($request) {
            if ($request->password_baru != $request->konfirmasi_password) {
                return back();
            } else {
                User::where("id", Auth::user()->id)->update([
                    "password" => bcrypt($request->password_baru)
                ]);

                if (Auth::user()->akses == "admin") {
                    return redirect("/admin/dashboard");
                } else if(Auth::user()->akses == "alumni") {
                    return redirect("/alumni/dashboard");
                }
    
            }
        });
    }
}
