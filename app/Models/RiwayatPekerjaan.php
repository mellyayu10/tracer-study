<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $table = "riwayat_pekerjaan";

    protected $guarded = [''];
    
    public $incrementing = false;

    protected $keyType = "string";

    public function alumni()
    {
        return $this->belongsTo("App\Models\Alumni", "alumni_id", "id");
    }
}
