@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">
                                Informasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">
                                Proker
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row my-3">
                                <div class="col-12">
                                    <form action="{{ route('master.anggaran.aksi.edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="anggaran_id" value="{{ $anggaran['anggaran_id'] }}">
                                        <div class="row mb-3">
                                            <label for="anggaran_name" class="col-md-2 col-form-label">Nama Anggaran <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="anggaran_name"
                                                    id="anggaran_name" value="{{ $anggaran['anggaran_name'] }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="anggaran_nominal" class="col-md-2 col-form-label">Total Anggaran
                                                <span class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="anggaran_nominal"
                                                    id="anggaran_nominal"
                                                    value="{{ number_format($anggaran->nominal(), 0, ',', '.') }}"
                                                    step="1" min="0" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="anggaran_deskripsi" class="col-md-2 col-form-label">Deskripsi <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <textarea name="anggaran_deskripsi" id="anggaran_deskripsi" cols="30" rows="10" class="form-control" required>{{ $anggaran['anggaran_deskripsi'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="anggaran_isActive" class="col-md-2 col-form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <select name="anggaran_isActive" id="anggaran_isActive" class="form-select"
                                                    required>
                                                    <option value="1"
                                                        {{ $anggaran['anggaran_isActive'] == 1 ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="0"
                                                        {{ $anggaran['anggaran_isActive'] == 0 ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <a class="btn btn-secondary float-start"
                                                    href="{{ route('master.anggaran.index') }}">Kembali</a>
                                                <button type="button" class="btn btn-danger float-end"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                                <button class="btn btn-primary btn-md float-end mx-2"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row my-3">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tableBase">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Nama Proker</th>
                                                    <th>Anggaran</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($anggaran->anggaranProker as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $value->proker['proker_name'] }}</td>
                                                    <td>{{ number_format($value['anggaran_proker_nominal'], 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal{{ $key }}">
                                                            Detail
                                                        </button>

                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modal{{ $key }}"
                                                            tabindex="-1" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" role="dialog"
                                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                                            <form action="{{ route('master.anggaran.proker.aksi.edit') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalTitleId">
                                                                                Ubah Anggaran Proker
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="anggaran_id" value="{{ $value['anggaran_id'] }}">
                                                                            <input type="hidden" name="proker_id" value="{{ $value['proker_id'] }}">
                                                                            <input type="hidden" name="anggaran_proker_id" value="{{ $value['anggaran_proker_id'] }}">
                                                                            <div class="row mb-3">
                                                                                <label for="anggaran_name"
                                                                                    class="col-md-4 col-form-label">Nama
                                                                                    Proker <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="anggaran_name"
                                                                                        id="anggaran_name"
                                                                                        value="{{ $value->proker['proker_name'] }}"
                                                                                        disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <label for="anggaran_proker_nominal"
                                                                                    class="col-md-4 col-form-label">Nominal
                                                                                    Anggaran <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control format-number"
                                                                                        name="anggaran_proker_nominal"
                                                                                        id="anggaran_proker_nominal"
                                                                                        value="{{ number_format($value['anggaran_proker_nominal'], 0, ',', '.') }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary"
                                                                                onclick="return confirm('Apakah Anda yakin?')">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Anggaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <strong>Apakah Anda yakin ingin menghapus data anggaran ini?</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('master.anggaran.aksi.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="anggaran_id" value="{{ $anggaran['anggaran_id'] }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
