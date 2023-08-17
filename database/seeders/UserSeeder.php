<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nama" => "Administrator",
            "username" => "administrator",
            "email" => "admin@gmail.com",
            "password" => bcrypt("administrator"),
            "nomor_hp" => "085324237299",
            "akses" => "admin"
        ]);
    }
}
