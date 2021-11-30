@extends('layouts.main')

@section('content')

<section id="header">
    <div class="container">
        <div class="header-item">
            <a href="">
                <div class="header-span">
                    <p><i class="bi bi-chevron-left"></i>Kembali</p>
                </div>
            </a>
        </div>

        <div class="header-profil" style="text-align: center;">
            <img src="..." alt="" class="profil-img"
                style="margin-top: 24px; border-radius: 50%;width: 128px;height: 128px;background-color: #f2f2f2;">
            <p class="profil-name" style="font-size: 20px;font-weight: 600;margin-top: 12px;">Bayu Pamungkas</p>
        </div>
    </div>
</section>
<section id="content" style="margin-top:40px">
    <div class="container">
        <div class="profil">
            <div class="profil-info">
                <p>Nama pengguna : bayu0605</p>
            </div>
            <div class="profil-info">
                <p>Kata sandi : *********</p>
            </div>
            <div class="profil-info">
                <p>Jenis kelamin : Laki - laki</p>
            </div>
            <div class="profil-info">
                <p>Kelas : Lima ( V )</p>
            </div>
            <div class="profil-info">
                <p>Status : Siswa</p>
            </div>
        </div>
        <div>
            <button class="btn btn-log-out"
                style="border-radius: 50px;padding: 18px;text-align: center;width: 100%;margin-top: 24px;border: none;background-color: #8e52f5;color: white;"
                type="submit">Log Out</button>
        </div>
    </div>
</section>
@endsection