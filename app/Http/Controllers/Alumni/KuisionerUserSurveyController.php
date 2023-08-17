<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;

class KuisionerUserSurveyController extends Controller
{
    public function index($id)
    {
        $data["riwayat"] = RiwayatPekerjaan::where("id", $id)->first();

        return view("pages.pengguna.kuisioner.v_index", $data);
    }
}
