<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisPenggunaAlumni extends Model
{
    use HasFactory;

    protected $table = "kuis_pengguna_alumni";

    protected $guarded = [''];

    public function riwayat_pekerjaan()
    {
        return $this->belongsTo("App\Models\RiwayatPekerjaan", "riwayat_pekerjaan_id", "id");
    }

    public $timestamps = false;
}
