<div class="sidebar">
    <a class="sidebar-brand" href="/home">
        <img src="/img/logowhite1.png" alt="">
    </a>
    <ul>
        <li class="sidebar-items {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="sidebar-items {{ Request::routeIs('admin.pengajuanpolis') ? 'active' : '' }}"><a href="{{ route('admin.pengajuanpolis') }}">Pengajuan Polis</a></li>
        <li class="sidebar-items {{ Request::routeIs('admin.prediksi') ? 'active' : '' }}"><a href="{{ route('admin.prediksi') }}">Prediksi</a></li>
        <li class="sidebar-items">
            <a href="{{ route('admin.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
