@extends('dashboard.layouts.main')

@section('content')
<div class="row mb-3 border-bottom">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 border mb-1 rounded">
        <div class="nav-toolbar">
            <nav class=""
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active"><a class="">Home</a></li>
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0 ">
            <div class="btn-group me-1">
                <button type="button" class="btn btn-sm btn-outline-primary"
                    onclick="location.href='/dashboard/teachers/create'"><i class="bi bi-person-plus"></i>
                    Tambah</button>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i>
                    Ekspor</button>
            </div>
        </div>
    </div>
</div>

<div class="row pt-3 justify-content-center">
    <div class="col-lg-4 mt-3 ">
        <div class="card bg-transparent border-0 w-75 text-center">
            <img src="{{ asset('/assets/images/bayu.jpg') }}" class="img-fluid rounded-circle shadow" alt="">
        </div>
    </div>
    <div class="col-lg-8 mt-3 ml-3 text-start shadow-sm border">
        <div class="row">
            <div class="col-5 align-middle">
                <h5>Nama lengkap</h5>
                <h5>Nama pengguna</h5>
                <h5>Kata sandi</h5>
                <h5>Status</h5>
                <h5>Mata pelajaran</h5>
                <h5>Wali kelas</h5>
                <h5>Ditambahkan pada</h5>
            </div>
            <div class="col align-middle">
                <h5>{{ $teacher->name }}</h5>
                <h5>{{ $teacher->username }}</h5>
                <h5>*********</h5>
                <h5>{{ $teacher->status->name }}</h5>
                <h5>{{ $teacher->subjects }}</h5>
                <h5>@if ( $teacher->status->homeroom>0 )
                    {{ $teacher->class }}
                    @endif</h5>
                <h5>{{ $teacher->created_at }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection