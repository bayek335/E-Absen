<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">E - Absen</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @if (!Request::is('dashboard'))
    <div class="d-flex text-white align-item-middle justify-content-end w-100">
        <p class="mx-2 my-0">{{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
        <p class="this-time my-0"></p>
    </div>
    @endif
    <div class="dropdown p-3 ">
        <div class="dropdown-toggle text-light text-end" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            Halo, Bayu Pamungkas
        </div>
        <ul class="dropdown-menu text-center px-3" style="left:-20px" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="/dashboard/profil/">Profil</a></li>
            <li>
                <a class="btn w-100 mt-2 btn-sm btn-danger" href="/logout"><small>Keluar <i
                            class="bi bi-box-arrow-right"></i></small></a>
            </li>
        </ul>
    </div>
</header>