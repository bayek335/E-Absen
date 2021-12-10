@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    @if (session()->has('fail'))
    <div class="alert alert-danger text-center mt-3">
        {{ session('fail') }}
    </div>
    @endif
    <div class="col-lg bg-light p-4 w-100 my-2 rounded shadow-sm">
        <form id="form-create-students" action="/dashboard/students/{{ $student->nisn }}" method="POST">

            @method('PUT')
            @csrf
            <small class="bg-warning p-3 w-100 text-center rounded">
                Untuk mengatur ulang <strong>Nama pengguna</strong> dan
                <strong>Kata sandi</strong>, klik Nisn dan Nama lengkap <i class="bi bi-exclamation-lg"></i>
            </small>
            <div class="row mb-3 mt-4" onkeyup="nisnUsernameOnKeyup(event)">
                <div class="col-sm-6">
                    <label for="nisn" class="form-label">NISN <small class="text-danger fw-bold">*</small></label>
                    <input type="text" class="form-control form-control-sm  @error('nisn') is-invalid @enderror "
                        id="nisn" aria-describedby="nisn" autocomplete="off" name="nisn" minlength="4" min="0"
                        value="@if(old('nisn')){{ old('nisn') }}@else{{$student->nisn}}@endif">
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
                        id="name" aria-describedby="name" autocomplete="off" name="name"
                        value="@if(old('name')){{ old('name') }}@else{{ $student->name }}@endif">
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
                    value="@if(old('name')){{ old('username') }}@else{{$student->username}}@endif" readonly>
                @error('username')
                <div class="fw-normal invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="password" class="form-label">Kata Sandi <small class="text-danger">*</small></label>
                <input type="text" class="form-control form-control-sm @error('password') is-invalid @enderror"
                    id="password" aria-describedby="password" autocomplete="off" name="password" readonly
                    value="{{ $student->username }}">
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
                        <option @if ($student->gender == 'laki-laki')
                            selected
                            @endif value="laki-laki">Laki-Laki</option>
                        <option @if ($student->gender == 'perempuan')
                            selected
                            @endif value="perempuan">Perempuan</option>
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
                        <option @if ($student->class_id == $class->id)
                            selected
                            @endif value="{{ $class->id }}">{{ $class->name }} ( {{ $class->roman }} )</option>
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