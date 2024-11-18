@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-hover" id="tableBase" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th class="text-center" style="width: 10%;">Tanggal</th>
                                        <th>Nama kegiatan</th>
                                        <th>Proker</th>
                                        <th class="text-center">Nominal</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($kegiatans as $i => $kegiatan) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?>.</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime($kegiatan->kegiatan_tanggal)) }}</td>
                                        <td><?= $kegiatan['kegiatan_name'] ?></td>
                                        <td><?= $kegiatan->proker['proker_name'] ?></td>
                                        <td class="text-center"><?= number_format($kegiatan['kegiatan_nominal'], 0, ',', '.')  ?></td>
                                        <td class="text-center">
                                            <a href="{{ route('master.kegiatan.view', $kegiatan['kegiatan_id']) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
