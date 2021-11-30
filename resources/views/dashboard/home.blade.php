@extends('dashboard.layouts.main')

@section('content')
<div class="row mb-3">
    <div class="col-lg-8 mb-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 ">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a>Home</a></li>
                </ol>
            </nav>
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
    </div>
    <div class="col-lg-4  text-center">
        <h1 class="this-time p-3 bg-primary rounded"></h1>
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
@endsection