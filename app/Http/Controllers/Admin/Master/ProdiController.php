<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data["prodi"] = Prodi::orderBy("created_at", "DESC")->get();
            
            return view("pages.admin.prodi.v_index", $data);
        });
    }
    
    public function store(Request $request)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            "nama_prodi" => "required"
        ], $messages);
        
        return DB::transaction(function() use ($request) {
            
            $cek = Prodi::where("nama_prodi", $request->nama_prodi)->count();
            
            if ($cek > 0) {
                return back()->with("error", "Nama Prodi Tidak Boleh Sama")->withInput();
            } else {
                Prodi::create($request->all());
                
                return back()->with("message", "Data Berhasil di Tambahkan"); 
            }
        });
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            "required" => "Kolom :attribute Harus Diisi"
        ];
        
        $this->validate($request, [
            "nama_prodi_edit" => "required"
        ], $messages);
        
        return DB::transaction(function() use ($request, $id) {

            $cek = Prodi::where("nama_prodi", $request->nama_prodi_edit)->count();

            if ($cek > 0) {
                return back()->with("error", "Nama Prodi Tidak Boleh Sama")->withInput();
            } else {
                Prodi::where("id", $id)->update([
                    "nama_prodi" => $request->nama_prodi_edit
                ]);
                
                return back()->with("message", "Data Berhasil di Simpan");
            }

        });
    }
    
    public function destroy($id)
    {
        return DB::transaction(function() use ($id) {
            Prodi::where("id", $id)->delete();
            
            return back()->with("message", "Data Berhasil di Hapus");
        });
    }
}
