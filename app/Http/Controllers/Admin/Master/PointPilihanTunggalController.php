<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\PointPilihanTunggal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointPilihanTunggalController extends Controller
{
    public function store(Request $request)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_point" => "required",
            "is_child" => "required"
        ], $message);
        
        return DB::transaction(function() use ($request) {
            PointPilihanTunggal::create($request->all());
            
            return back()->with("message", "Data Berhasil di Tambahkan"); 
        });
    }
    
    public function update(Request $request, $id)
    {
        $message = [
            "required" => "Kolom :attribute Harus Diisi"
        ];

        $this->validate($request, [
            "nama_point" => "required",
            "is_child" => "required",
        ], $message);
        
        return DB::transaction(function() use ($request, $id) {
            PointPilihanTunggal::where("id", $id)->update([
                "nama_point" => $request->nama_point,
                "is_child" => $request->is_child
            ]);
            
            return back()->with("message", "Data Berhasil di Simpan");
        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            PointPilihanTunggal::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
