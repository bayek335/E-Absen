@extends('dashboard.layouts.main')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <form class="form-create-teacher" action="/dashboard/teachers" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror " id="name"
                    aria-describedby="name" autocomplete="off" autofocus name="name"
                    value="@if(old('name')){{ old('name') }}@endif">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                    id="username" aria-describedby="username" autocomplete="off" name="username"
                    value="@if(old('name')){{ old('username') }}@endif">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                    id="password" aria-describedby="password" autocomplete="off" name="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-select-sm @error('status') is-invalid @enderror" id="status"
                    aria-describedby="status" onchange="statusOnChange(event)" name="status">
                    <option value="">Pilih...</option>
                    @foreach ($status as $st)
                    <option @if(old('status')==$st->id){{ 'selected' }} @endif value="{{ $st->id
                        }}">@if($st->homeroom>0){{ 'Wali
                        kelas' }}@else{{ $st->name }}@endif
                    </option>
                    @endforeach
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 d-none">
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
            <div class="mb-3">
                <label for="subject" class="form-label">Mata Pelajaran <small>( opsional, dapat lebih dari
                        1)</small>
                    <small onclick="onDeleteSubject()" role="button"
                        class="badge bg-warning text-dark">kosongkan</small>
                </label>
                <select type="email" class="form-select form-select-sm @error('subjects') is-invalid @enderror"
                    id="subject" aria-describedby="subject" onchange="subjectOnChange(event)">
                    <option value="">Pilih...</option>
                    @foreach ($subjects as $subject)
                    <option data-subject_id="{{ $subject->id }}" value="{{ $subject->name }}">{{ $subject->name }}
                    </option>
                    @endforeach
                </select>
                @error('subjects')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <input id="subjects" type="text" readonly class="form-control border p-2 mt-2 bg-light" name="subjects">

            </div>
            <button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
        </form>
    </div>
</div>

<script>
    if(document.querySelector("select#status").value==2){
        document.querySelector(".form-create-teacher .d-none").classList.replace('d-none', 'd-block')
    }
    statusOnChange = (e)=>{
        if(e.target.value == 2){
            document.querySelector(".form-create-teacher .d-none").classList.replace('d-none', 'd-block')
        }else if(document.querySelector(".form-create-teacher .d-block")){
            document.querySelector(".form-create-teacher .d-block").classList.replace('d-block', 'd-none')
        }
    }

    let subject_area = document.querySelector("#subjects");
    const subjects = [];
    subjectOnChange=(e)=>{
        if (!subjects.includes(e.target.value)) {
        subjects.push(e.target.value)
        }
        subject_area.value = subjects
    }
    onDeleteSubject=()=>{
        subjects.splice(0);
        subject_area.value = subjects

    }

</script>

@endsection