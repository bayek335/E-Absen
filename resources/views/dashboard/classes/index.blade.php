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
@if(session()->has('success'))
<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <div class="alert alert-success">{!! session('success') !!}</div>
    </div>
</div>
@endif
<div class="row classes">
    <div class="col-md-5">
        <h5 class="form-title">Tambah data</h5>
        <div class="bg-light p-3">
            <form action="/dashboard/classes" method="post" data-id="" class="form-class">
                @csrf
                <div class="mb-3">
                    <label for="num" class="form-label d-block">Kelas</label>
                    <p class="d-inline bg-secondary py-2 px-5 bg-light border rounded ">Pilih kelas dalam angka</p>
                    <input type="hidden" name="class" id="class">
                    <select class="form-select d-inline-flex" style="max-width: 15px" id="num"
                        placeholder="Kelas dalam angka" max="12" min="1" onchange="classToRoman(event)">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('name'){{ 'is-invalid' }}@enderror" id="name"
                        placeholder="Kelas dalam abjad" autocomplete="off" name="name" readonly>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="roman" class="form-label">Romawi</label>
                    <input type="text" class="form-control @error('roman'){{ 'is-invalid' }}@enderror" id="roman"
                        name="roman" readonly>
                    @error('roman')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-primary px-5">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-7 overflow-auto">
        <h5>List kelas</h5>
        <table class="table table-bordered table-hover shadow">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Romawi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)

                <tr>
                    <th scope="row">{{ $class->id }}</th>
                    <td>{{ $class->class }}</td>
                    <td>{{ ucfirst($class->name) }}</td>
                    <td>{{ $class->roman }}</td>
                    <td>
                        <form class="d-inline">
                            <button type="button" class="btn badge bg-danger"
                                onclick="onDeleteButton(event, {{ $class->id }}, '{{ csrf_token() }}', '/dashboard/classes/')">Hapus</button>
                        </form>
                        <a role="button" class="badge bg-success text-decoration-none"
                            onclick="editClassHandler({{ $class->id }})">Ubah</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection