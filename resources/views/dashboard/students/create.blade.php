@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    @if (session()->has('fail'))
    <div class="alert alert-danger text-center mt-3">
        {{ session('fail') }}
    </div>
    @endif
    <div class="col-lg bg-light p-4 w-100 my-2 rounded shadow-sm">
        <form id="form-create-students" action="/dashboard/students" method="POST">
            @csrf
            <div class="row mb-3" onkeyup="nisnUsernameOnKeyup(event)">
                <div class="col-sm-6">
                    <label for="nisn" class="form-label">NISN <small class="text-danger fw-bold">*</small></label>
                    <input type="number" class="form-control form-control-sm  @error('nisn') is-invalid @enderror "
                        id="nisn" aria-describedby="nisn" autocomplete="off" autofocus name="nisn"
                        value="@if(old('nisn')){{ old('nisn') }}@endif">
                    @error('nisn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="name" class="form-label">Nama Lengkap <small
                            class="text-danger fw-bold">*</small></label>
                    <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror "
                        id="name" aria-describedby="name" autocomplete="off" autofocus name="name"
                        value="@if(old('name')){{ old('name') }}@endif">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="username" class="form-label">Nama Pengguna <small class="text-danger">*</small></label>
                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                    id="username" aria-describedby="username" autocomplete="off" name="username"
                    value="@if(old('name')){{ old('username') }}@endif" readonly>
                @error('username')
                <div class="fw-normal invalid-feedback">php ar
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="password" class="form-label">Kata Sandi <small class="text-danger">*</small></label>
                <input type="text" class="form-control form-control-sm @error('password') is-invalid @enderror"
                    id="password" aria-describedby="password" autocomplete="off" name="password" readonly>
                @error('password')
                <div class="fw-normal invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="gender" class="form-label">Jenis kelamin</label>
                    <select name="gender" id="gender"
                        class="form-select form-select-sm @error('gender') is-invalid @enderror">
                        <option value="">Pilih...</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="class" class="form-label">Kelas</label>
                    <select class="form-select form-select-sm @error('class') is-invalid @enderror" id="class"
                        aria-describedby="class" name="class">
                        <option value="">Pilih....</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }} ( {{ $class->roman }} )</option>
                        @endforeach
                    </select>
                    @error('class')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button id="student_btn_submit" type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
        </form>
    </div>
</div>
@endsection