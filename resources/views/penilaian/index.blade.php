@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class=py-4>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Status Keberhasil</h4>
                        <div class="card">
                            <div class="card-body ">
                                <p class="card-text">Nilai Asesmen Kecukupan : <b>{{ $score_hitung }}</b></p>
                                <p class="card-text">Syarat Perlu Terakreditasi : <b>
                                        @if ($terakreditas->count() >= 3)
                                            <span class="badge badge-success">TERPENUHI</span>
                                        @else
                                            <span class="badge badge-danger">TIDAK TERPENUHI</span>
                                        @endif
                                    </b></p>
                                <p class="card-text">Syarat Perlu Peringkat Unggul : <b>
                                        @if ($unggul->count() >= 4)
                                            <span class="badge badge-success">TERPENUHI</span>
                                        @else
                                            <span class="badge badge-danger">TIDAK TERPENUHI</span>
                                        @endif
                                    </b></p>
                                <p class="card-text">Syarat Perlu Peringkat Baik Sekali : <b>
                                        @if ($baik->count() >= 4)
                                            <span class="badge badge-success">TERPENUHI</span>
                                        @else
                                            <span class="badge badge-danger">TIDAK TERPENUHI</span>
                                        @endif
                                    </b>
                                </p>
                                <hr>
                                <p class="card-text">Element Pertimbangan : <b>{{ $count_element }}</b> Element
                                </p>
                                <p class="card-text">Ketersediaan Berkas : <b>{{ $count_berkas }}</b> Berkas</p>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Diagram Pencapaian</h4>
                        @if (!$target['l1'])
                            <div class="alert alert-primary" role="alert">
                                Program Studi {{ $p->name }} belum memiliki target pencapaian, silahkan buat target
                                pencapaian untuk menampilkan diagram
                            </div>
                        @else
                            <canvas id="radarChart" width="300" height="300"></canvas>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Matrik Penilain {{ $p->name }}</h6>
                    </div>
                    <div class="card-body">
                        @if (session()->has('pesan'))
                            {!! session()->get('pesan') !!}
                        @endif
                        {{-- @foreach ($alert as $i)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                Tinggkatkan Kualitas pada <b>{{ $i->l1->name }}</b> {!! $i->indikator->dec !!} <a
                                    href="{{ url('element/unggah-berkas/' . $i->id) }}" target="_blank">Klik disini
                                    !!!</a>
                            </div>
                        @endforeach --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Element</th>
                                        <th width="70px">Item</th>
                                        <th width="70px">Score</th>
                                        <th width="70px">Bobot</th>
                                        <th width="70px">Score x Bobot</th>
                                        <th>Syarat Perlu Akreditasi</th>
                                        <th>Syarat Peringkat Unggul</th>
                                        <th>Syarat Peringkat Baik</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Element</th>
                                        <th width="70px">Item</th>
                                        <th width="70px">Score</th>
                                        <th width="70px">Bobot</th>
                                        <th width="70px">Score x Bobot</th>
                                        <th>Syarat Perlu Akreditasi</th>
                                        <th>Syarat Peringkat Unggul</th>
                                        <th>Syarat Peringkat Baik</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($e as $i)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            @if (($i->l2_id == 0) & ($i->l3_id == 0) & ($i->l4_id == 0))
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {!! $i->indikator->dec !!}
                                                </td>
                                            @elseif($i->l3_id == 0 & $i->l4_id == 0)
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                    {!! $i->indikator->dec !!}
                                                </td>
                                            @elseif($i->l4_id == 0)
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                    {{ $i->l3->name }}<br>
                                                    {!! $i->indikator->dec !!}
                                                </td>
                                            @else()
                                                <td>
                                                    <b>{{ $i->l1->name }}</b><br>
                                                    {{ $i->l2->name }}<br>
                                                    {{ $i->l3->name }}<br>
                                                    {{ $i->l4->name }}<br>
                                                    {!! $i->indikator->dec !!}
                                                </td>
                                            @endif
                                            <td>
                                                @if ($i->count_berkas < 1)
                                                    {{ 'Tidak Ada Berkas' }}
                                                @else
                                                    {{ $i->count_berkas . ' Berkas' }}
                                                @endif
                                            </td>
                                            <td>{{ $i->score_berkas }}</td>
                                            <td>{{ $i->bobot }}</td>

                                            @if ($i->score_hitung > 10)
                                                <td>{{ $i->score_hitung }}</td>
                                            @elseif($i->score_hitung > 1)
                                                <td>{{ ltrim($i->score_hitung, 0) }}</td>
                                            @else
                                                <td> {{ $i->score_hitung }}</td>
                                            @endif

                                            @if ($i->min_akreditasi > 0)
                                                @if ($i->status_akreditasi == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_akreditasi }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_akreditasi }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($i->min_unggul > 0)
                                                @if ($i->status_unggul == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_unggul }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_unggul }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($i->min_baik > 0)
                                                @if ($i->status_baik == 'Y')
                                                    <td>
                                                        MIN = <b>{{ $i->min_baik }}</b>
                                                        <hr>
                                                        <span class="badge badge-success">Terpenuhi</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        MIN = <b>{{ $i->min_baik }}</b>
                                                        <hr>
                                                        <span class="badge badge-danger">Tidak Terpenuhi</span>
                                                    </td>
                                                @endif
                                            @else
                                                <td></td>
                                            @endif
                                        </tr>
                                        <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @if (!$target['l1'])
        <script>
            console.log("Data Tidak Ditemukan !")
        </script>
    @else
        @section('script')
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
            <script>
                const options = {
                    type: 'radar',
                    data: {
                        labels: ["A. Kondisi Eksternal", "B. Profil Unit Pengelola Program Studi",
                            "C.1. Visi, Misi, Tujuan dan Strategi", "C.2. Tata Pamong, Tata Kelola dan Kerjasama",
                            "C.3. Mahasiswa", "C.4. Sumber Daya Manusia", "C.5. Keuangan, Sarana dan Prasarana",
                            "C.6. Pendidikan", "C.7. Penelitian", "C.8. Pengabdian kepada Masyarakat",
                            "C.9. Luaran dan Capaian Tridharma", "D. Analisis dan Penetapan Program Pengembangan"
                        ],
                        datasets: [{
                                label: "Target Program Studi",
                                backgroundColor: "rgba(200,0,0,0.2)",
                                data: [<?= $target['l1']->value ?>, <?= $target['l2']->value ?>,
                                    <?= $target['l3']->value ?>,
                                    <?= $target['l4']->value ?>, <?= $target['l5']->value ?>,
                                    <?= $target['l6']->value ?>,
                                    <?= $target['l7']->value ?>, <?= $target['l8']->value ?>,
                                    <?= $target['l9']->value ?>,
                                    <?= $target['l10']->value ?>, <?= $target['l11']->value ?>,
                                    <?= $target['l12']->value ?>
                                ]
                            },
                            {
                                label: "Nilai Tercapai",
                                backgroundColor: "rgba(0,0,200,0.2)",
                                data: [<?= $pencapaian['l1'] ?>, <?= $pencapaian['l2'] ?>,
                                    <?= $pencapaian['l3'] ?>, <?= $pencapaian['l4'] ?>,
                                    <?= $pencapaian['l5'] ?>, <?= $pencapaian['l6'] ?>,
                                    <?= $pencapaian['l7'] ?>, <?= $pencapaian['l8'] ?>,
                                    <?= $pencapaian['l9'] ?>, <?= $pencapaian['l10'] ?>,
                                    <?= $pencapaian['l11'] ?>, <?= $pencapaian['l12'] ?>
                                ]
                            }
                        ]
                    },
                    options: {
                        onClick: (evt, activeEls, chart) => {
                            const {
                                x,
                                y
                            } = evt;
                            let index = -1;

                            for (let i = 0; i < chart.scales.r._pointLabelItems.length; i++) {
                                const {
                                    bottom,
                                    top,
                                    left,
                                    right
                                } = chart.scales.r._pointLabelItems[i];

                                if (x >= left && x <= right && y >= top && y <= bottom) {
                                    index = i;
                                    break;
                                }
                            }

                            if (index === -1) {
                                return;
                            }

                            const clickedLabel = chart.scales.r._pointLabels[index];
                            var URL = document.URL + "/" + clickedLabel;
                            window.open(URL);
                            console.log(clickedLabel)
                        }
                    }
                }

                const ctx = document.getElementById('radarChart').getContext('2d');
                new Chart(ctx, options);
            </script>

        @endsection
    @endif
