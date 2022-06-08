@extends('template.HomeView')
@section('content')


    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section>
            <div class="container">

                <div class="section-title">
                    <h2>{{ $e->l1->name }}</h2>
                    <p>{!! $e->indikator->dec !!}</p>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Dec</th>
                                    <th width="150px">Score</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Dec</th>
                                    <th width="150px">Score</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($b as $i)
                                    <tr>
                                        <td><a href="{{ url('tabel/view/' . $i->id) }}"
                                                target="_blank">{{ $i->file_name }}</a>
                                        </td>
                                        <td>{!! $i->dec !!}</td>
                                        <td>{{ $i->score }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


    </main>
    <!-- End #main -->
@endsection
