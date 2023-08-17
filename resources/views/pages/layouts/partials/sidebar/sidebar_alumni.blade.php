<li class="menu-title">Menu</li>
<li class="{{ Request::segment(2) == "dashboard" ? 'mm-active' : '' }}">
    <a href="{{ url('/alumni/dashboard') }}" class="waves-effect">
        <i class="fa fa-home"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="{{ Request::segment(2) == "rekomendasi" ? 'mm-active' : '' }}">
    <a href="{{ url('/alumni/rekomendasi') }}" class="waves-effect">
        <i class="fa fa-edit"></i>
        <span>Rekomendasi Alumni</span>
    </a>
</li>
<li class="{{ Request::segment(2) == "ganti_password" ? 'mm-active' : '' }}">
    <a href="{{ url('/alumni/ganti_password') }}" class="waves-effect">
        <i class="fa fa-key"></i>
        <span>Ganti Password</span>
    </a>
</li>
