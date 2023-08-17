<?php

use App\Http\Controllers\Admin\Laporan\LaporanController;
use App\Http\Controllers\Admin\Master\InstansiController;
use App\Http\Controllers\Admin\Master\KategoriKuisionerController;
use App\Http\Controllers\Admin\Master\KelolaKuisMahasiswaController;
use App\Http\Controllers\Admin\Master\PointPilihanGandaController;
use App\Http\Controllers\Admin\Master\PointPilihanTunggalController;
use App\Http\Controllers\Admin\Master\ProdiController;
use App\Http\Controllers\Admin\Master\SettingKategoriKuisionerController;
use App\Http\Controllers\Admin\Pengaturan\ProfilSayaController;
use App\Http\Controllers\Admin\User\AdministratorController;
use App\Http\Controllers\Admin\User\AlumniController;
use App\Http\Controllers\Admin\User\PenggunaAlumniController;
use App\Http\Controllers\Admin\Wilayah\WilayahController;
use App\Http\Controllers\Alumni\KuisionerMahasiswaController;
use App\Http\Controllers\Alumni\KuisionerUserSurveyController;
use App\Http\Controllers\Alumni\RekomendasiTempatController;
use App\Http\Controllers\Alumni\RiwayatPekerjaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\PenggunaAlumni\KuisController;
use App\Http\Controllers\Public\Password\GantiPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/link/{id}", [AppController::class, "link"]);
Route::get("/pengguna_alumni/{id}", [AppController::class, "kuis_survey"]);
Route::get("/data_instansi_autocomplete", [InstansiController::class, "dataAutoComplete"]);
Route::get("/detail_instansi", [InstansiController::class, "detailInstansi"]);

Route::post("/pengguna_alumni/{id}", [KuisController::class, "store"]);
Route::get("/success", [KuisController::class, "success"]);
Route::get("/get-parent", [LaporanController::class, "child_options"]);

Route::group(["middleware" => ["guest"]], function() {
    Route::get("/", [LoginController::class, "welcome"]);
    Route::prefix("login")->group(function() {
        Route::get("/", [LoginController::class, "login"]);
        Route::post("/", [LoginController::class, "post_login"]);
    });
});

Route::group(["middleware" => ["cek"]], function() {
    Route::group(["middleware" => ["can:admin"]], function() {
        Route::prefix("admin")->group(function() {

            Route::prefix("wilayah")->group(function() {
                Route::get("/ambil_kota_kab", [WilayahController::class, "ambil_kota_kab"]);
                Route::get("/ambil_kecamatan", [WilayahController::class, "ambil_kecamatan"]);
                Route::get("/ambil_kelurahan", [WilayahController::class, "ambil_kelurahan"]);
            });

            Route::get("/dashboard", [AppController::class, "dashboard_admin"]);

            Route::resource("instansi", InstansiController::class);
            
            Route::get("/kelola_pekerjaan", [AppController::class, "kelola_pekerjaan"]);
            Route::put("/kelola_pekerjaan/{id}/ditolak", [AppController::class, "ditolak"]);
            Route::put("/kelola_pekerjaan/{id}/diterima", [AppController::class, "diterima"]);
            Route::put("/kelola_pekerjaan/{id}", [AppController::class, "ubah_status"]);
            Route::put("/kelola_pekerjaan/{id}/update", [AppController::class, "update"]);

            Route::prefix("laporan")->group(function() {
                Route::get("/pekerjaan", [LaporanController::class, "pekerjaan"]);
                Route::post("/pekerjaan", [LaporanController::class, "search_pekerjaan"]);
                Route::post("/pekerjaan/download", [LaporanController::class, "download_pekerjaan"]);
                Route::get("/kuisioner_pengguna_alumni", [LaporanController::class, "kuisioner_pengguna_alumni"]);
                Route::post("/kuisioner_pengguna_alumni", [LaporanController::class, "post_kuisioner_pengguna_alumni"]);
            });

            Route::resource("prodi", ProdiController::class);
            Route::resource("data_administrator", AdministratorController::class);

            Route::prefix("kelola_kuis")->group(function() {
                Route::get("/report", [KelolaKuisMahasiswaController::class, "report"]);
                Route::get("/get-soal", [KelolaKuisMahasiswaController::class, "getSoal"]);
                Route::get("/{slug}", [KelolaKuisMahasiswaController::class, "index"]);
                Route::post("/{slug}", [KelolaKuisMahasiswaController::class, "store"]);
                Route::get("/{id}/download", [KelolaKuisMahasiswaController::class, "download"]);
            });

            Route::prefix("kategori_kuisioner")->group(function() {
                Route::prefix("{id}")->group(function() {
                    Route::prefix("isian")->group(function() {
                        Route::post("/", [KategoriKuisionerController::class, "create_isian"]);
                        Route::put("/{id_detail_kuisioner}", [KategoriKuisionerController::class, "put_detail_kategori_kuisioner"]);
                        Route::delete("/", [KategoriKuisionerController::class, "delete_isian"]);
                    });
                    Route::prefix("pilihan_ganda")->group(function() {
                        Route::post("/", [KategoriKuisionerController::class, "create_pilihan_ganda"]);
                        Route::put("/{id_detail_kuisioner}", [KategoriKuisionerController::class, "put_detail_kategori_kuisioner_pilihan_ganda"]);
                        Route::get("/{id_detail_kuisioner}/detail", [KategoriKuisionerController::class, "detail_kategori_kuisioner_pilihan_ganda"]);
                        Route::delete("/", [KategoriKuisionerController::class, "delete_pilihan_ganda"]);
                    });
                    Route::prefix("pilihan_tunggal")->group(function() {
                        Route::post("/", [KategoriKuisionerController::class, "create_pilihan_tunggal"]);
                        Route::put("/{id_detail_kuisioner}", [KategoriKuisionerController::class, "put_detail_kategori_kuisioner_pilihan_tunggal"]);
                        Route::get("/{id_detail_kuisioner}/detail", [KategoriKuisionerController::class, "detail_kategori_kuisioner_pilihan_tunggal"]);
                        Route::delete("/", [KategoriKuisionerController::class, "delete_pilihan_tunggal"]);
                    });
                });
            });
            Route::put("/kategori_kuisioner/{id}/aktifkan", [KategoriKuisionerController::class, "aktifkan"]);
            Route::put("/kategori_kuisioner/{id}/non_aktifkan", [KategoriKuisionerController::class, "non_aktifkan"]);
            Route::resource("kategori_kuisioner", KategoriKuisionerController::class);

            Route::resource("point_pilihan_ganda", PointPilihanGandaController::class);
            Route::resource("point_pilihan_tunggal", PointPilihanTunggalController::class);

            Route::post("/setting_kategori_kuisioner/aktifkan", [SettingKategoriKuisionerController::class, "aktifkan"]);
            Route::post("/setting_kategori_kuisioner/non_aktifkan", [SettingKategoriKuisionerController::class, "non_aktifkan"]);

            Route::get("/data_pengguna_alumni", [PenggunaAlumniController::class, "index"]);
            Route::resource("data_alumni", AlumniController::class);

            Route::get("/informasi_login", [AppController::class, "informasi_login_all"]);

            Route::prefix("profil_saya")->group(function() {
                Route::get("/", [ProfilSayaController::class, "index"]);
                Route::put("/", [ProfilSayaController::class, "update"]);
            });

            Route::prefix("ganti_password")->group(function() {
                Route::get("/", [GantiPasswordController::class, "index"]);
                Route::put("/", [GantiPasswordController::class, "update"]);
            });
        });
    });
    Route::group(["middleware" => ["can:alumni"]], function() {
        Route::prefix("alumni")->group(function() {
            Route::get("/dashboard", [AppController::class, "dashboard_alumni"]);

            Route::prefix("wilayah")->group(function() {
                Route::get("/ambil_kota_kab", [WilayahController::class, "alumni_ambil_kota_kab"]);
                Route::get("/ambil_kecamatan", [WilayahController::class, "alumni_ambil_kecamatan"]);
                Route::get("/ambil_kelurahan", [WilayahController::class, "alumni_ambil_kelurahan"]);

                Route::get("/ambil_kota_kab_pekerjaan", [WilayahController::class, "alumni_ambil_kota_kab"]);
                Route::get("/ambil_kecamatan_pekerjaan", [WilayahController::class, "alumni_ambil_kecamatan"]);
                Route::get("/ambil_kelurahan_pekerjaan", [WilayahController::class, "alumni_ambil_kelurahan"]);
            });

            Route::resource("riwayat_pekerjaan", RiwayatPekerjaanController::class);

            Route::prefix("kuis_mahasiswa")->group(function() {
                Route::get("/create/{id}", [KuisionerMahasiswaController::class, "create"]);
                Route::post("/store/{id}", [KuisionerMahasiswaController::class, "store"]);
                Route::post("/store/status/belum", [KuisionerMahasiswaController::class, "store_belum"]);
            });
            Route::put("/update_profil", [AppController::class, "update_profil"]);
            Route::get("/ganti_password", [GantiPasswordController::class, "index"]);
            Route::put("/ganti_password", [GantiPasswordController::class, "update"]);

            Route::resource("rekomendasi", RekomendasiTempatController::class);
        });

        Route::prefix("pengguna")->group(function() {
            Route::get("/kuisioner/{id}", [KuisionerUserSurveyController::class, "index"]);
        });
    });
    Route::get("/logout", [LoginController::class, "logout"]);
});
