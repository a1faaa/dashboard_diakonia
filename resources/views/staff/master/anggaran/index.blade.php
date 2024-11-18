@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('master.anggaran.add') }}" class="btn btn-sm btn-success float-end">Tambah
                                Anggaran</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-hover" id="tableBase" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th>Nama Anggaran</th>
                                        <th class="text-center">Nominal</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($anggarans as $i => $anggaran) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?>.</td>
                                        <td><?= $anggaran['anggaran_name'] ?></td>
                                        <td class="text-center"><?= number_format($anggaran->nominal(), 0, ',', '.')  ?></td>
                                        <td><?= $anggaran['anggaran_deskripsi'] ?></td>
                                        <td class="text-center"><?= $anggaran['anggaran_isActive']? 'Aktif': 'Tidak Aktif' ?></td>
                                        <td class="text-center">
                                            <a href="{{ route('master.anggaran.edit', $anggaran['anggaran_id']) }}"
                                                class="btn btn-info btn-sm">Detil</a>
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
