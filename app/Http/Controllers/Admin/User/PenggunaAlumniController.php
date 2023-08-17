<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaAlumniController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $data["pengguna_alumni"] = RiwayatPekerjaan::select("pengguna_alumni", "divisi", "email", "nomor_hp", "nama_instansi")->distinct()->get();

            return view("pages.admin.pengguna_alumni.v_index", $data);
        });
    }
}
