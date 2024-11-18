@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('master.proker.add') }}" class="btn btn-sm btn-success float-end">Tambah
                                Proker</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-hover" id="tableBase" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th>Nama Proker</th>
                                        <th>Tujuan</th>
                                        <th>Sasaran</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($prokers as $i => $proker) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?>.</td>
                                        <td><?= $proker['proker_name'] ?></td>
                                        <td><?= $proker['proker_tujuan'] ?></td>
                                        <td><?= $proker['proker_sasaran'] ?></td>
                                        <td class="text-center"><?= $proker['proker_isActive']? 'Aktif': 'Tidak Aktif' ?></td>
                                        <td class="text-center">
                                            <a href="{{ route('master.proker.edit', $proker['proker_id']) }}"
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
