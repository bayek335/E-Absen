<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">E - Absen</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="dropdown p-3 ">
        <div class="dropdown-toggle text-light text-end" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            Bayu Pamungkas
        </div>
        <ul class="dropdown-menu text-end" style="left:-20px" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="/dashboard/profil/">Profil</a></li>
            <li>
                <form action="" method="post" class="px-3">
                    @method("DELETE")
                    @csrf
                    <button class="btn btn-sm btn-danger" type="submit">Keluar</button>
                </form>
            </li>
        </ul>
    </div>
</header>