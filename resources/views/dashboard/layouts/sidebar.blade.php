<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <a href="/dashboard" class="fw-bold text-decoration-none " style="color:#2470dc">BERANDA</a>
        </h6>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span class="fw-bold">ADMIN</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <i class="bi bi-plus"></i>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/teachers*')) active @endif" href="/dashboard/teachers">
                    <i class="bi bi-file"></i>
                    Guru
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span class="fw-bold">KONTROL</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <i class="bi bi-plus"></i>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/classes*')) active @endif" href="/dashboard/classes">
                    <i class="bi bi-border-all"></i>
                    Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/students*')) active @endif" href="/dashboard/students">
                    <i class="bi bi-border-all"></i>
                    Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/schedules*')) active @endif" href="/dashboard/schedules">
                    <i class="bi bi-border-all"></i>
                    Jadwal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/absents*')) active @endif" href="/dashboard/absents">
                    <i class="bi bi-border-all"></i>
                    Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/reports*')) active @endif" href="/dashboard/reports">
                    <i class="bi bi-border-all"></i>
                    Laporan
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span class="fw-bold">TAMBAHAN</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <i class="bi bi-border-all"></i>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(Request::is('dashboard/settings*')) active @endif" href="/dashboard/settings">
                    <i class="bi bi-border-all"></i>
                    Pengaturan
                </a>
            </li>
        </ul>
    </div>
</nav>