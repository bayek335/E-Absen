@extends('dashboard.layouts.main')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Beranda</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Ekspor</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" id="dropdownMenuButton1"
                data-bs-toggle="dropdown">
                <i class="bi bi-calendar-date"></i>
                Tanggal
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
    <style>
        .card .bi {
            font-size: 60px;
        }
    </style>
    <div class="row">
        <div class="col-md-4 mt-3">
            <div class="card d-flex shadow-sm flex-row justify-content-around">
                <div class="icon p-2 text-center">
                    <i class="bi bi-person-fill  align-middle"></i>
                </div>
                <div class="card-body  ">
                    <h4 class="card-text mt-3">12 Guru</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card d-flex shadow-sm flex-row justify-content-around">
                <div class="icon p-2 text-center">
                    <i class="bi bi-people-fill  align-middle"></i>
                </div>
                <div class="card-body  ">
                    <h4 class="card-text mt-3">73 Siswa</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3 mb-3">
            <div class="card d-flex shadow-sm flex-row justify-content-around">
                <div class="icon p-2 text-center">
                    <i class="bi bi-door-closed-fill  align-middle"></i>
                </div>
                <div class="card-body  ">
                    <h4 class="card-text mt-3 ">6 Kelas</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="heading d-flex justify-content-between">
                <h4 class="align-middle">Siswa</h4>
                <a href="/dashboard/students" class="btn btn-sm btn-primary">Selengkapnya</a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="">Bayu Pamungkas</a></td>
                            <td>Lima ( V )</td>
                            <td>Siswa</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection