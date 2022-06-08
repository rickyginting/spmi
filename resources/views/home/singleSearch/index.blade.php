@extends('template.HomeView',['title'=>"Single Search"])
@section('content')


    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section>
            <div class="container">

                <div class="section-title">
                    <h2>Single Search</h2>
                    <p>Pencarian berdasarkan nama dokument yang ada</p>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="s130">
                            <form action="/single-search/hasil" method="POST">
                                @csrf
                                <div class="inner-form">
                                    <div class="input-field first-wrap">
                                        <div class="svg-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input id="search" type="text" name="filename" required
                                            placeholder="Cari Dokument Yang dibutuhkan ?" />
                                    </div>
                                    <div class="input-field second-wrap">
                                        <button class="btn-search" type="submit">Cari</button>
                                    </div>
                                </div>
                                <span class="info">ex. File123</span>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


    </main>
    <!-- End #main -->
@endsection
