<li class="nav-item">
    <a href="{{ route('dashboards.index') }}" class="nav-link {{ Request::is('dashboards*') ? 'active' : '' }}">
        <i class="far fa-chart-pie nav-icon"></i>
        <p>Dashboard</p>
    </a>
</li>

@if(auth()->user()->hasRole('admin'))
<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon far fa-database"></i>
        <p>
        Data Master
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('criterias.index') }}" class="nav-link {{ Request::is('criterias*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Kriteria</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('subCriterias.index') }}" class="nav-link {{ Request::is('subCriterias*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Kriteria</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('periods.index') }}"
            class="nav-link {{ Request::is('periods*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Periode</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('dss.index') }}" class="nav-link {{ Request::is('dss*') ? 'active' : '' }}">
        <i class="far fa-laptop nav-icon"></i>
        <p>Proses Pemilihan</p>
    </a>
</li>
@endif

@if(auth()->user()->hasRole(['admin', 'surveyor']))
<li class="nav-item">
    <a href="{{ route('populations.index') }}" class="nav-link {{ Request::is('populations*') ? 'active' : '' }}">
        <i class="far fa-users nav-icon"></i>
        <p>Penduduk</p>
    </a>
</li>
@endif

@if(auth()->user()->hasRole(['receiver']))
<li class="nav-item">
    <a href="{{ route('riwayat-data.index') }}" class="nav-link {{ Request::is('riwayat-data*') ? 'active' : '' }}">
        <i class="far fa-users nav-icon"></i>
        <p>Riwayat Data</p>
    </a>
</li>
@endif

<li class="nav-item">
    <a href="{{  route('profiles.index') }}" class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}">
        <i class="far fa-user nav-icon"></i>
        <p>Identitas Diri</p>
    </a>
</li>
