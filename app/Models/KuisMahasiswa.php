<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisMahasiswa extends Model
{
    use HasFactory;

    protected $table = "kuis_mahasiswa";

    protected $guarded = [''];

    public function alumni()
    {
        return $this->belongsTo("App\Models\Alumni", "alumni_id", "id");
    }

    public $timestamps = false;
}
