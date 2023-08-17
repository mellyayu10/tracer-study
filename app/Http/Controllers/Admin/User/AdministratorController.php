<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdministratorController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data["admin"] = User::where("akses", "admin")->orderBy("created_at", "DESC")->get();
            
            return view("pages.admin.administrator.v_index", $data);
        });
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "max" => "Kolom :attribute Maximal Harus :max Digit"
        ];

        $this->validate($request, [
            "nama" => "required",
            "email" => "required",
            "nomor_hp" => "required|min:12|max:15"
        ], $messages);

        return DB::transaction(function() use($request) {
            User::create([
                "nama" => $request->nama,
                "username" => Str::slug($request->nama),
                "emil" => $request->email,
                "password" => bcrypt("administrator"),
                "nomor_hp" => $request->nomor_hp,
                "created_by" => Auth::user()->id,
                "akses" => "admin"
            ]);
            
            return back()->with("message", "Data Berhasil di Tambahkan");
        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi",
            "min" => "Kolom :attribute Minimal Harus :min Digit",
            "max" => "Kolom :attribute Maximal Harus :max Digit"
        ];

        $this->validate($request, [
            "nama" => "required",
            "email" => "required",
            "nomor_hp" => "required|min:12|max:15"
        ], $messages);
        
        return DB::transaction(function () use ($request, $id) {
            User::where("id", $id)->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            User::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
