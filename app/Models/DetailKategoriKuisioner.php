<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKategoriKuisioner extends Model
{
    use HasFactory;

    protected $table = "detail_kategori_kuisioner";

    protected $guarded = [''];

    public function kategori_kuisioner()
    {
        return $this->belongsTo("App\Models\KategoriKuisioner", "kategori_kuisioner_id", "id");
    }
}
