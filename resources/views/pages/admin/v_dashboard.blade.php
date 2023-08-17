@php
use Carbon\Carbon;
@endphp

@extends("pages.layouts.main")

@section("title", "Dashboard Admin")

@section("content")

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    @yield("title")
                </h4>
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
    @if (session("success"))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success mb-0" role="alert">
                <h5 class="alert-heading font-size-16">
                    Selamat Datang
                    <strong>
                        {{ Auth::user()->nama }}
                    </strong>
                    !
                </h5>
                <p>
                    Anda Login Sebagai <strong style="color: blue;">Administrator</strong>
                    <strong>
                        Aplikasi Study Tracer
                    </strong>
                </p>
                <hr>
                <p class="mb-0">
                    Silahkan Pilih Menu Untuk Melanjutkan Program.
                </p>
            </div>
        </div>
    </div>
    <br>
    @endif
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h3 class="mb-3">
                                            <span class="counter_value" data-target="{{ $data_alumni }}">
                                                {{ $data_alumni }}
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14 mb-0">
                                    Data Alumni
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h3 class="mb-3">
                                            <span class="counter_value" data-target="{{ $data_administrator }}">
                                                {{ $data_administrator }}
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14 mb-0">
                                    Data Administrator
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h3 class="mb-3">
                                            <span class="counter_value" data-target="{{ $rekomendasi_alumni }}">
                                                {{ $rekomendasi_alumni }}
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14 mb-0">
                                    Daftar Rekomendasi
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Aktivitas Login Saya
                    </h4>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $nomer = 0
                                    @endphp
                                    @forelse ($informasi_login as $data)
                                    <tr>
                                        <td class="text-center">{{ ++$nomer }}.</td>
                                        <td class="text-center">
                                            {!! Carbon::createFromFormat('Y-m-d H:i:s', $data->tanggal)->isoFormat('D MMMM Y') !!}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            <strong>
                                                <i>
                                                    Aktivitas Login Belum Ada
                                                </i>
                                            </strong>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
