<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointPilihanGanda extends Model
{
    use HasFactory;

    protected $table = "point_pilihan_ganda";

    protected $guarded = [''];

    public function detail_kategori_kuisioner()
    {
        return $this->belongsTo("App\Models\DetailKategoriKuisioner", "detail_kategori_kuisioner_id", "id");
    }
}
