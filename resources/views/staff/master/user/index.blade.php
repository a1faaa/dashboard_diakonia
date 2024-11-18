@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="{{ route('master.user.add') }}" class="btn btn-sm btn-success float-end">Tambah
                                Data</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-hover" id="tableBase" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th>Username</th>
                                        <th>Fullname</th>
                                        <th class="text-center" style="width: 10%;">Role</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($users as $i => $user) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?>.</td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['fullname'] ?></td>
                                        <td class="text-center"><?= $user['role'] == 9? 'Admin': 'User' ?></td>
                                        <td class="text-center">
                                            <a href="{{ route('master.user.edit', $user['user_id']) }}"
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
