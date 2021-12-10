@extends('dashboard.layouts.main')

@section('content')
<div class="row show-student justify-content-center mt-3">
    <div class="col-md-8 text-center">
        <div class="card shadow-sm ">
            <div class="card-header position-relative">
                <div class="position-relative text-end mb-3">
                    <a href="/dashboard/students/{{ $student->nisn }}/edit"
                        class="btn btn-sm btn-success px-3"><small><i class="bi bi-pencil-square"></i> Ubah</small></a>
                    <button class="btn btn-sm btn-danger px-3"
                        onclick="onDeleteButton(event, {{ $student->nisn }}, '{{ csrf_token() }}', '/dashboard/students/')"><small><i
                                class="bi bi-trash"></i> Hapus</small></button>
                </div>
                <div class="student-img-profile overflow-hidden rounded-circle shadow-sm m-auto d-flex justify-content-center position-relative"
                    style="width: 228px;height:228px">
                    <div class="spinner-border text-light position-absolute " style="top:45%;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <img id="profile-picture" alt="image profile" src="{{ asset($student->image) }}">
                </div>
                <label for="image" class="position-absolute start-50 translate-middle" role="button">
                    <i class="bi bi-camera-fill fs-4 text-dark bg-light p-2 py-0 pb-1 rounded shadow-sm border"></i>
                </label>
                <input onchange="updateProfileImage({{ $student->id }}, '{{ csrf_token() }}')" type="file" name="image"
                    id="image" class="visually-hidden">

                <h5 class="mt-4">{{ $student->name }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-horizontal text-start ">
                    <li class="list-group-item border-0 border-bottom w-100 ">NISN</li>
                    <li class="list-group-item border-0 border-bottom w-100 "><strong>{{ $student->nisn }} </strong>
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start ">
                    <li class="list-group-item border-0 border-bottom w-100 text-success">Nama pengguna</li>
                    <li class="list-group-item border-0 border-bottom w-100 text-success">{{ $student->username }}
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100 text-success">Kata sandi</li>
                    <li class="list-group-item border-0 border-bottom w-100 text-success">
                        <p id="password" class="d-inline">********</p>
                        <small onclick="showPasswordStudentOnClick('{{ $student->status->name }}')"><a
                                class="text-decoration-none float-end" role="button"><i class="bi bi-unlock"></i>
                                Lihat
                                password</a></small>
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100">Kelas</li>
                    <li class="list-group-item border-0 border-bottom w-100">{{ ucFirst($student->class->name)}} (
                        {{
                        $student->class->roman }} )</li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100">Keterangan</li>
                    <li class="list-group-item border-0 border-bottom w-100">{{ ucFirst($student->status->name) }}
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100">Jenis kelamin</li>
                    <li class="list-group-item border-0 border-bottom w-100">{{ ucFirst($student->gender) }} </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100">Ditambahkan pada</li>
                    <li class="list-group-item border-0 border-bottom w-100">{{ ucFirst($student->created_at) }}
                    </li>
                </ul>
                <ul class="list-group list-group-horizontal text-start">
                    <li class="list-group-item border-0 border-bottom w-100">Diperbarui pada</li>
                    <li class="list-group-item border-0 border-bottom w-100">{{ ucFirst($student->updated_at) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection