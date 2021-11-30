@extends('dashboard.layouts.main')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <form class="form-create-teacher" action="/dashboard/teachers" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm" id="fullname" aria-describedby="fullname">
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control form-control-sm" id="username" aria-describedby="username">
            </div>
            <div class="mb-3 text-success fw-bold">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control form-control-sm" id="password" aria-describedby="password"
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control form-control-sm" id="status" aria-describedby="status"
                    onchange="statusOnChange(event)">
                    <option value="">Pilih...</option>
                    <option value="1">Kepala Sekolah</option>
                    <option value="2">Guru dan Wali Kelas</option>
                    <option value="3">Guru</option>
                </select>
            </div>
            <div class="mb-3 d-none">
                <label for="class" class="form-label">Kelas</label>
                <input type="number" class="form-control form-control-sm" id="class" aria-describedby="class">
            </div>
            <div class="mb-3">
                <label for="teaching" class="form-label">Mata Pelajaran</label>
                <select type="email" class="form-control form-control-sm" id="teaching" aria-describedby="teaching">
                    <option value="">Pilih...</option>
                    <option value="ipa">IPA</option>
                    <option value="matematika">Matematika</option>
                    <option value="bahasa_indonesia">B.Indonesia</option>
                    <option value="bahasa_inggris">B.Inggris</option>
                </select>
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
</script>

@endsection