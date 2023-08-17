@php
$data = json_decode($kuisioner, true);
$textData = isset($data['text']) ? $data['text'] : null;
@endphp

@extends("pages.layouts.main")

@section("title", "Detail Kuisioner Alumni")

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
                        <li class="breadcrumb-item">
                            <a href="{{ url('/alumni/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/alumni/kuis_mahasiswa') }}">
                                Kuisioner
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail Kuisioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" style="width: 100%">
                        <tbody>
                            @if ($textData && is_array($textData))
                            @foreach ($textData as $key => $value)
                            <p>{{ $key }}: {!! $value !!}</p>
                            @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection