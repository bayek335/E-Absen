@extends('dashboard.layouts.main')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <form class="form-create-teacher" action="/dashboard/teachers" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror " id="name"
                    aria-describedby="name" autocomplete="off" autofocus name="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                    id="username" aria-describedby="username" autocomplete="off" name="username">
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
                <select class="form-control form-control-sm @error('status') is-invalid @enderror" id="status"
                    aria-describedby="status" onchange="statusOnChange(event)" name="status">
                    <option value="">Pilih...</option>
                    <option value="1">Kepala Sekolah</option>
                    <option value="2">Guru dan Wali Kelas</option>
                    <option value="3">Guru</option>
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 d-none">
                <label for="class" class="form-label">Kelas</label>
                <input type="number" class="form-control form-control-sm @error('class') is-invalid @enderror"
                    id="class" aria-describedby="class" name="class">
                @error('class')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Mata Pelajaran <small>( opsional, dapat lebih dari
                        1)</small></label>
                <select type="email" class="form-control form-control-sm @error('subjets') is-invalid @enderror"
                    id="subject" aria-describedby="subject" onchange="subjectOnChange(event)">
                    <option value="">Pilih...</option>
                    <option value="IPA">IPA</option>
                    <option value="MATEMATIKA">MATEMATIKA</option>
                    <option value="BAHASA INDONESIA">BAHASA INDONESIA</option>
                    <option value="BAHASA INGGRIS">BAHAS INGGRIS</option>
                </select>
                @error('subjects')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input id="subjects" class="form-control form-control-sm mt-2" type="text" readonly name="subjects">
            </div>
            <button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
        </form>
    </div>
</div>

<script>
    statusOnChange = (e)=>{
        if(e.target.value == 2){
            document.querySelector(".form-create-teacher .d-none").classList.replace('d-none', 'd-block')
        }else if(document.querySelector(".form-create-teacher .d-block")){
            document.querySelector(".form-create-teacher .d-block").classList.replace('d-block', 'd-none')
        }
    }

        const subjects = [];
    subjectOnChange=(e)=>{
        subjects.push(e.target.value)
        document.querySelector("#subjects").value = subjects.join(', ');
    }

</script>

@endsection