@extends('template.HomeView',['title'=>" $b->file_name "])
@section('content')


    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section>
            <div class="container">

                <div class="section-title">
                    <h2>{{ $b->file_name }}</h2>
                    <p>{!! $b->dec !!}</p>
                </div>

                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ asset('document/' . $b->file) }}"
                                    allowfullscreen></iframe>
                            </div>
                            <hr>
                            @if (($b->l2_id == 0) & ($b->l3_id == 0) & ($b->l4_id == 0))
                                {{ $b->l1->name }}<br>
                            @elseif($b->l3_id == 0 & $b->l4_id == 0)
                                {{ $b->l1->name }}<br>
                                {{ $b->l2->name }}
                            @elseif($b->l4_id == 0)
                                {{ $b->l1->name }}<br>
                                {{ $b->l2->name }}<br>
                                {{ $b->l3->name }}
                            @else()
                                {{ $b->l1->name }}<br>
                                {{ $b->l2->name }}<br>
                                {{ $b->l3->name }}<br>
                                {{ $b->l4->name }}
                            @endif
                            <hr>
                            Program Studi : <b>{{ $b->prodi->name }} - ({{ $b->prodi->kode }})</b><br>
                            Nilai Yang Didapat : <b>{{ $b->score }}</b>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


    </main>
    <!-- End #main -->
@endsection
