@extends('template.HomeView',['title'=>"Home"])
@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url({{ asset('home/img/slide/slide-1.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">LPM Smart Sistem</h2>
                            <p class="animate__animated animate__fadeInUp">Aplikasi berbasis web untuk mengatasi
                                pemberkasan dokument akreditasi pada Perguruan Tinggi.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url({{ asset('home/img/slide/slide-2.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Multiple Search</h2>
                            <p class="animate__animated animate__fadeInUp">Memungkinkan melakukan pencarian sampai ke
                                sub folder berkas.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url({{ asset('home/img/slide/slide-3.jpg') }})">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Diagram Pencapaian</h2>
                            <p class="animate__animated animate__fadeInUp">Menampilkan informasi pencapaian dan nilai
                                asessmen untuk setiap Program Studi.</p>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section>
    <!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services section-bg">
            <div class="container">

                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-laptop"></i></div>
                            <h4 class="title"><a href="">Efesien</a></h4>
                            <p class="description">Dengan menerapkan penyimpanan berkas secara cloud, berkas akan
                                lebih mudah dan aman saat disimpan
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-briefcase"></i></div>
                            <h4 class="title"><a href="">Cepat</a></h4>
                            <p class="description">Berkas akan lebih mudah dicari jika akan dibutuhkan saat akan
                                dilakukan validasi kembali.
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                            <h4 class="title"><a href="">Tepat</a></h4>
                            <p class="description">Dengan adanya laporan pencapaian nilai asesmen stakeholder dapat
                                mengambil keputusan yang tepat dalam melakukan perbaikan mutu.
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Featured Services Section -->

        <!-- ======= About Us Section ======= -->
        <section>
            <div class="container">

                <div class="section-title">
                    <h2>LPM Smart Sistem</h2>
                    <p>Memperbaiki tata kelola pemberkasan menjadi lebih baik dan efesian,mincipatakan simulasi perhitungan
                        nilai asesmen pencapaian suatu Program Studi.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2">
                        <img src="{{ asset('home/img/about.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3>Data Program Studi Terdaftar Pada Sistem.</h3>
                        <p class="fst-italic">
                            Berikut adalah data Program Studi yang terdaftar pada LPM Smart Sistem di Kampus <b>STMIK Pelita
                                Nusantara</b>
                        </p>
                        <ul>
                            @foreach ($data['p'] as $i)
                                <li><i class="bi bi-check-circled"></i><a
                                        href="{{ url('diagram/' . $i->kode) }}">{{ $i->name }} -
                                        <b>{{ $i->kode }}</b> ({{ $i->jenjang->kode }})</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


    </main>
    <!-- End #main -->
@endsection
