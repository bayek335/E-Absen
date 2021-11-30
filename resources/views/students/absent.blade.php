@extends('layouts.main')

@section('content')
<section id="header">
    <div class="container">
        <div class="header-item" style="padding: 24px 0;">
            <a href="">
                <div class="header-span">
                    <p><i class="bi bi-chevron-left"></i>Kembali</p>
                </div>
            </a>
            <div class="btn-log-out">
                <a href="#" type="submit">Log Out <i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container" style="padding-top: 60px;">
        <div class="absensi-message">
            Kamu belum <span class="text-danger">Absensi Masuk<i class="bi bi-exclamation-lg"></i></span>
        </div>
        <div class="jadwal-pelajaran">
            <div class="card-jadwal">
                <div class="card-title" style="margin-top: 3px;">Absensi</div>
                <div class="card-body">
                    <p>Jam masuk <span>06.45</span></p>
                    <p style="margin-top: 16px;color: rgb(50, 165, 50);">Masuk <span>07.15</span></p>
                    <p>Jam pulang <span>12.00</span></p>
                    <p style="margin-top: 16px; color: rgb(248, 69, 69);">Pulang <span><i class="bi bi-x-circle"></i>
                            Kosong</span></p>
                </div>
            </div>
        </div>
        <div class="jadwal-pelajaran" style="margin-top: 24px;text-align: center;">
            <div class="card-jadwal">
                <div class="card-title" style="font-size: 18px;">Absen</div>
                <div class="card-body" style="margin: 40px 0 26px 0;">
                    <form action="" method="post" style="margin-bottom: 0;">
                        <button type="submit"><img src="..." alt=""
                                style="width: 100px;height: 100px;border: none;border-radius: 50%;"></button>
                    </form>
                    <p style="margin-top: 24px;">Tekan tombol ini</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection