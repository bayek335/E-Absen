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

<div class="row pt-3 justify-content-center bg-light">
    <div class="col-md-4 col-6 mt-3 ">
        <div class="card bg-transparent border-0 text-center">
            <img src="{{ asset('/assets/images/bayu.jpg') }}" class="img-fluid rounded-circle shadow" alt="">
        </div>
    </div>
    <div class="col-lg-8 mt-3 ml-3 text-start px-4 py-2">
        <div class="row bg-white shadow-sm border p-3">
            <div class="col-12">
                <form action="/dashboard/teachers/{{ $teacher->id }}" method="post" class="d-inline mb-2">
                    @method("DELETE")
                    @csrf
                    <button class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Hapus</button>
                </form>
                <a href="/dashboard/teachers/{{ $teacher->id }}/edit" class="btn btn-sm btn-success d-inline"><i
                        class="bi bi-pencil-square"></i> Perbarui</a>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group mb-3">
                    <label>Nama lengkap</label>
                    <input type="text" class="form-control" readonly value="{{ $teacher->name }}">
                </div>
                <div class="form-group mb-3">
                    <label>Nama pengguna</label>
                    <input type="text" class="form-control" readonly value="{{ $teacher->username }}">
                </div>
                <div class="form-group mb-3">
                    <label>Kata sandi</label>
                    <input type="text" class="form-control" readonly value="********">
                </div>
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <label>Status</label>
                        <input type="text" class="form-control" readonly value="{{ $teacher->status->name }}">
                    </div>
                    @if ($teacher->status->homeroom >0)
                    <div class="form-group col-6">
                        <label>Wali kelas</label>
                        <input type="text" class="form-control" readonly
                            value="{{ $teacher->class->name.' ( '. $teacher->class->roman.' )'}}">
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Guru Mata Pelajaran</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($teacher->subjects as $subject)
                        <h6>{{ $subject->name }}</h6>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection