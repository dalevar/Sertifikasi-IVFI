@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center display-4">Mewujudkan Tenaga Vokasi Farmasi yang Profesional dan Berdaya Saing</h1>
                <p class="text-center display-7">Kami hadir untuk mendukung pengembangan keterampilan, memberikan akses ke
                    pelatihan<br>
                    bersertifikasi, serta memperjuangkan kepentingan tenaga teknis kefarmasian dalam dunia industri dan
                    kesehatan.</p>
                <div class="flex flex-col items-center mt-5 text-center justify-content-center">
                    <a href="{{ url('/register') }}" class="btn btn-primary me-2">Daftar Sekarang</a>
                    <a href="{{ url('/login') }}" class="btn btn-secondary ms-2">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="flex justify-center mt-5 col-md-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="-" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="display-4">Struktur Organisasi IVFI: Bersama Membangun Profesi Farmasi</h2>
        <p>Dikelola oleh para profesional di bidang farmasi dan pendidikan vokasi, IVFI memiliki tim yang berdekadahu untuk
            mendukung pengembangan tenaga farmasi di Indonesia.</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CEO</h5>
                        <p class="card-text">Figura ipsum component</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CTO</h5>
                        <p class="card-text">Figura ipsum component</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CFO</h5>
                        <p class="card-text">Figura ipsum component</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="mt-3 btn btn-primary">Lihat Semua</a>
    </div>
@endsection
