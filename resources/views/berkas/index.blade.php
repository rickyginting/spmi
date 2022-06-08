@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Berkas</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Element</th>
                                    <th>Berkas</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Element</th>
                                    <th>Berkas</th>
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
                                        <td><a href="{{ url('berkas/' . $i->id) }}"
                                                class="btn btn-info btn-sm">{{ $i->file_name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
