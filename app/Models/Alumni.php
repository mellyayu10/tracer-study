<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = "alumni";

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }

    public function prodi()
    {
        return $this->belongsTo("App\Models\Prodi", "prodi_id", "id");
    }
}
