@extends('template.HomeView',['title'=>"Hasil Pencarian"])
@section('content')


    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section>
            <div class="container">

                <div class="section-title">
                    <h2>Hasil Pencarian Dokumen</h2>
                    <p>Menampilkan <b>{{ $berkas->count() }}</b> berkas dokument berdasarkan kata kunci pencarian yang
                        telah
                        ditentukan.</b>
                    </p>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Element</th>
                                        <th>Berkas</th>
                                        <th>Program Studi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Element</th>
                                        <th>Berkas</th>
                                        <th>Program Studi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($berkas as $i)
                                        <tr>
                                            <td>
                                                {{ $i->l1->name }}<br />
                                                {{ $i->l2->name }}<br />
                                                {{ $i->l3->name }}<br />
                                                {{ $i->l4->name }}
                                            </td>
                                            <td><a href="{{ url('tabel/view/' . $i->id) }}"
                                                    class="btn btn-info btn-sm">{{ $i->file_name }}</a>
                                            </td>
                                            <td>
                                                <b>{{ $i->prodi->name }} - ({{ $i->prodi->kode }})</b>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


    </main>
    <!-- End #main -->
@endsection
