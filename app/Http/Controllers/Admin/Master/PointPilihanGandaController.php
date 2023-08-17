<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\PointPilihanGanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointPilihanGandaController extends Controller
{
    public function store(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_point" => "required"
        ], $message);
        
        return DB::transaction(function() use ($request) {
            PointPilihanGanda::create($request->all());
            
            return back()->with("message", "Data Berhasil di Tambahkan"); 
        });
    }
    
    public function update(Request $request, $id)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_point" => "required"
        ], $message);
        
        return DB::transaction(function() use ($request, $id) {
            PointPilihanGanda::where("id", $id)->update([
                "nama_point" => $request->nama_point
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            PointPilihanGanda::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
