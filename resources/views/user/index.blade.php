@extends('layout.user')
@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            Rp {{ number_format($anggaran_nominal, 2, ',', '.') }}
                        </div>
                        <div>Anggaran</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70" width="410"
                        style="display: block; box-sizing: border-box; height: 70px; width: 410px;"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-md-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">Rp {{ number_format($total_pengeluaran['nominal'], 2, ',', '.') }}
                            <span class="fs-6 fw-normal">({{ number_format($total_pengeluaran['persentase'], 2) }}%)</span>
                        </div>
                        <div>Total Pengeluaran</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70" width="410"
                        style="display: block; box-sizing: border-box; height: 70px; width: 410px;"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        @php
        // Default color is green
        $warna = 'bg-success';

        // Determine color based on persentase
        if ($total_tersisa['persentase'] <= 5) {
            $warna = 'bg-cui-red';
        } elseif ($total_tersisa['persentase'] <= 15) {
            $warna = 'bg-cui-orange';
        } elseif ($total_tersisa['persentase'] <= 25) {
            $warna = 'bg-cui-yellow';
        }
    @endphp
    <div class="col-md-4">
        <div class="card text-white {{ $warna }} h-100">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start h-100">
                <div>
                    <div class="fs-4 fw-semibold">Rp {{ number_format($total_tersisa['nominal'], 2, ',', '.') }} <span
                            class="fs-6 fw-normal">({{ number_format($total_tersisa['persentase'], 2) }}%)</span></div>
                    <div>Total Tersisa</div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3" style="height:70px;">
                <canvas class="chart" id="card-chart3" height="70" width="442"
                    style="display: block; box-sizing: border-box; height: 70px; width: 442px;"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-6">
        <canvas id="anggaranChart" class="responsive-chart"></canvas>
    </div>
    <div class="col-sm-6">
        <canvas id="pengeluaranChart" class="responsive-chart"></canvas>
    </div>
</div>
<div class="row my-3">
    <div class="col-12 d-flex justify-content-center flex-wrap">
        <canvas id="yearChart" width="800" height="400"></canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">Pengeluaran Proker</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table table-hover mb-0" id="tableBase" style="width: 100% !important;">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th class="" style="width: 40%;">Nama Proker</th>
                                    <th class="" style="width: 50%;">Pengeluaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                    foreach ($listProkers as $key => $value) {
                                ?>
                                <tr>
                                    <td class="text-center">{{ $counter + 1 }}</td>
                                    <td>
                                        {{ $value['proker_name'] }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <div class="fw-semibold">{{ $value['percentage'] }}%</div>
                                            <div class="text-nowrap small text-body-secondary ms-3">
                                                Rp {{ number_format($value['nominal'], 2, ',', '.') }} / Rp
                                                {{ number_format($value['anggaran_proker_nominal'], 2, ',', '.') }}                                                </div>
                                        </div>
                                        <div class="progress progress-thin mb-3">
                                            <div class="progress-bar bg-{{ $value['color'] }}" role="progressbar"
                                                style="width: {{ $value['percentage'] }}%"
                                                aria-valuenow="{{ $value['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.kegiatan.filter', [$key]) }}"
                                            class="btn btn-info btn-sm">Detil</a>
                                    </td>
                                </tr>
                                <?php
                                $counter++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
@endsection
@section('script')
    <script>
        // Format the total using Intl.NumberFormat
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        // Pass PHP data to JavaScript using json_encode()
        const listProkers = <?php echo json_encode($listProkers); ?>;
        const anggaranNominal = <?php echo json_encode($anggaran_nominal); ?>;
        const totalPengeluaran = <?php echo json_encode($total_pengeluaran); ?>;

        // Prepare data for the first pie chart (Anggaran Proker Nominal)
        const anggaranLabels = Object.values(listProkers).map(proker => proker.proker_name);
        const anggaranData = Object.values(listProkers).map(proker => proker.anggaran_proker_nominal);

        // Prepare data for the second pie chart (Pengeluaran per Proker)
        const pengeluaranLabels = Object.values(listProkers).map(proker => proker.proker_name);
        const pengeluaranData = Object.values(listProkers).map(proker => proker.nominal);

        // First Pie Chart: Anggaran Proker vs Total Anggaran
        const anggaranCtx = document.getElementById('anggaranChart').getContext('2d');
        new Chart(anggaranCtx, {
            type: 'pie',
            data: {
                labels: anggaranLabels,
                datasets: [{
                    label: 'Anggaran Proker Nominal',
                    data: anggaranData,
                    backgroundColor: [
                        // CHART WARNA BUNGLON
                        'rgba(255, 0, 0, 0.6)', // Merah Cerah
                        'rgba(0, 127, 255, 0.6)', // Biru Laut
                        'rgba(0, 255, 0, 0.6)', // Hijau Daun
                        'rgba(255, 255, 0, 0.6)', // Kuning Cerah
                        'rgba(255, 165, 0, 0.6)', // Jingga
                        'rgba(128, 0, 128, 0.6)', // Ungu
                        'rgba(255, 192, 203, 0.6)', // Merah Muda
                        //'rgba(128, 128, 128, 0.6)', // Abu-abu
                        'rgba(0, 0, 139, 0.6)', // Biru Tua
                        'rgba(0, 255, 255, 0.6)' // Cyan
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: `Anggaran Proker Nominal (Total: ${formatter.format(anggaranNominal)})`
                    }
                }
            }
        });

        // Second Pie Chart: Pengeluaran per Proker vs Total Pengeluaran
        const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
        new Chart(pengeluaranCtx, {
            type: 'pie',
            data: {
                labels: pengeluaranLabels,
                datasets: [{
                    label: 'Pengeluaran per Proker',
                    data: pengeluaranData,
                    backgroundColor: [
                        // CHART WARNA BUNGLON
                        'rgba(255, 0, 0, 0.6)', // Merah Cerah
                        'rgba(0, 127, 255, 0.6)', // Biru Laut
                        'rgba(0, 255, 0, 0.6)', // Hijau Daun
                        'rgba(255, 255, 0, 0.6)', // Kuning Cerah
                        'rgba(255, 165, 0, 0.6)', // Jingga
                        'rgba(128, 0, 128, 0.6)', // Ungu
                        'rgba(255, 192, 203, 0.6)', // Merah Muda
                        //'rgba(128, 128, 128, 0.6)', // Abu-abu
                        'rgba(0, 0, 139, 0.6)', // Biru Tua
                        'rgba(0, 255, 255, 0.6)' // Cyan
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: `Pengeluaran Proker (Total: ${formatter.format(totalPengeluaran.nominal)})`
                    }
                },
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($tahuns); // Convert the PHP array to JSON

            const anggaranNames = data.map(item => item.anggaran_name);
            const realisasiValues = data.map(item => item.realisasi);
            const anggaranValues = data.map(item => item.anggaran);

            const ctx = document.getElementById('yearChart').getContext('2d');
            const yearChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: anggaranNames,
                    datasets: [{
                        label: 'Realisasi',
                        data: realisasiValues,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false
                    }, {
                        label: 'Anggaran',
                        data: anggaranValues,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Anggaran dan Realisasi Per Tahun',
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
