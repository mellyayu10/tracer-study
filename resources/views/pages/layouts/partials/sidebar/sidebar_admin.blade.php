@php
use App\Models\KategoriKuisioner;
@endphp

<li class="menu-title">Menu</li>
<li class="{{ Request::segment(2) == "dashboard" ? 'mm-active' : '' }}">
    <a href="{{ url('/admin/dashboard') }}" class="waves-effect">
        <i class="ri-dashboard-line"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="menu-title">Menu</li>

<li class="{{ Request::segment(2) == "kategori_kuisioner" ? 'mm-active' : '' }} || {{ Request::segment(2) == "prodi" ? 'mm-active' : '' }} || {{ Request::segment(2) == 'data_pengguna_alumni' ? 'mm-active' : '' }} {{ Request::segment(2) == "instansi" ? 'mm-active' : '' }} ">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ri-profile-line"></i>
        <span>Master</span>
    </a>
    <ul class="sub-menu {{ Request::segment(2) == "prodi" ? 'mm-show' : '' }} || {{ Request::segment(2) == "kategori_kuisioner" ? 'mm-show' : '' }} || {{ Request::segment(2) == "data_pengguna_alumni" ? 'mm-show' : '' }} {{ Request::segment(2) == "instansi" ? 'mm-show' : '' }} " aria-expanded="false">
        <li class="{{ Request::segment(2) == "prodi" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/prodi') }}">
                Prodi
            </a>
        </li>
        <li class="{{ Request::segment(2) == "kategori_kuisioner" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/kategori_kuisioner') }}">
                Kategori Kuisioner
            </a>
        </li>
        <li class="{{ Request::segment(2) == "data_pengguna_alumni" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/data_pengguna_alumni') }}">
                Data Pengguna Alumni
            </a>
        </li>
        <li class="{{ Request::segment(2) == "instansi" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/instansi') }}">
                Data Instansi
            </a>
        </li>
    </ul>
</li>

<li class="{{ Request::segment(2) == "data_alumni" ? 'mm-active' : '' }} || {{ Request::segment(2) == "kelola_pekerjaan" ? 'mm-active' : '' }}">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ri-profile-line"></i>
        <span>Alumni</span>
    </a>
    <ul class="sub-menu {{ Request::segment(2) == "kelola_pekerjaan" ? 'mm-show' : '' }} || {{ Request::segment(2) == "data_alumni" ? 'mm-show' : '' }}" aria-expanded="false">
        
        <li class="{{ Request::segment(2) == "kelola_pekerjaan" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/kelola_pekerjaan') }}">
                Daftar Rekomendasi
            </a>
        </li>
        <li class="{{ Request::segment(2) == "data_alumni" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/data_alumni') }}">
                Data Alumni
            </a>
        </li>
        {{-- <li class="{{ Request::segment(2) == "data_administrator" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/data_administrator') }}">
                Data Administrator
            </a>
        </li> --}}
    </ul>
</li>

<li class="menu-title"> Kuisioner </li>

<li class="{{ Request::segment(2) == 'kelola_kuis' ? 'mm-active' : '' }}">
    <a href="{{url('admin/kelola_kuis/report')}}" class="waves-effect">
        <i class="fa fa-edit"></i>
        <span>Laporan Kuisioner</span>
    </a>
    {{-- <ul class="sub-menu {{ Request::segment(2) == 'kelola_kuis' ? 'mm-show' : '' }} " aria-expanded="false">
        @php
        $data = KategoriKuisioner::where("status", 1)->where("tipe_kuisioner", 1)->get();
        @endphp
        @foreach ($data as $item)
        <li class="{{ Request::segment(3) == $item["slug"] ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/kelola_kuis/'.$item["slug"]) }}">
                {{ $item["nama_kategori_kuisioner"] }}
            </a>
        </li>
        @endforeach
    </ul> --}}
</li>

<li class="menu-title"> Laporan </li>

<li class="{{ Request::segment(2) == "laporan" ? 'mm-active' : '' }}">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ri-profile-line"></i>
        <span>Laporan</span>
    </a>
    <ul class="sub-menu {{ Request::segment(2) == "laporan" ? 'mm-show' : '' }}" aria-expanded="false">
        {{-- <li class="{{ Request::segment(3) == "pekerjaan" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/laporan/pekerjaan') }}">
                Pekerjaan
            </a>
        </li> --}}
        <li class="{{ Request::segment(3) == "kuisioner_pengguna_alumni" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/laporan/kuisioner_pengguna_alumni') }}">
                Kuisioner Pengguna Alumni
            </a>
        </li>
    </ul>
</li>

<li class="menu-title"> Pengaturan </li>

<li class="{{ Request::segment(2) == "profil_saya" ? 'mm-active' : '' }} || {{ Request::segment(2) == "ganti_password" ? 'mm-active' : '' }}">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ri-profile-line"></i>
        <span>Akun</span>
    </a>
    <ul class="sub-menu {{ Request::segment(2) == "profil_saya" ? 'mm-show' : '' }} || {{ Request::segment(2) == "ganti_password" ? 'mm-show' : '' }} " aria-expanded="false">
        <li class="{{ Request::segment(2) == "profil_saya" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/profil_saya') }}">
                Profil Saya
            </a>
        </li>
        <li class="{{ Request::segment(2) == "ganti_password" ? 'mm-active' : '' }}">
            <a href="{{ url('/admin/ganti_password') }}">
                Ganti Password
            </a>
        </li>
    </ul>
</li>
