@extends('layouts.main')

@section('content')

<section id="header">
    <div class="container">
        <div class="header-item">
            <a href="">
                <div class="header-span">
                    <img src="">
                    <div class="header-name">Bayu Pamungkas</div>
                </div>
            </a>
            <div class="btn-log-out">
                <a href="#" type="submit">Keluar <i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="welcome-text">
            Selamat datang di web sd negeri 4 konoha
        </div>
        <div class="absensi-message">
            Kamu sudah <span>Absensi Masuk<i class="bi bi-check-lg"></i></span>
        </div>
        <div class="jadwal-pelajaran">
            <div class="title">
                Jadwal Pelajaran
            </div>
            <div class="card-jadwal">
                <div class="card-title">Hari ini</div>
                <div class="card-body">
                    <p>07.00 - 08.00 <span>Matematika</span></p>
                    <p>07.00 - 08.00 <span>Matematika</span></p>
                    <p>07.00 - 08.00 <span>Matematika</span></p>
                    <p>07.00 - 08.00 <span>Matematika</span></p>
                    <p>07.00 - 08.00 <span>Matematika</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection