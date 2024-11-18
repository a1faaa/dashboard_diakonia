@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.kegiatan.aksi.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan['kegiatan_id'] }}">
                        <div class="row mb-3">
                            <label for="anggaran_id" class="col-md-2 col-form-label">Nama Anggaran<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="anggaran_id" id="anggaran_id"
                                    value="{{ $kegiatan->anggaran['anggaran_id'] }}">
                                <input type="text" class="form-control"
                                    value="{{ $kegiatan->anggaran['anggaran_name'] }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proker_id" class="col-md-2 col-form-label">Nama Proker <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select name="proker_id" id="proker_id" class="form-select" required>
                                    <?php
                                foreach ($prokers as $key => $proker) {
                            ?>
                                    <option value="{{ $proker['proker_id'] }}"
                                        {{ $proker['proker_id'] == $kegiatan['proker_id'] ? 'selected' : '' }}>
                                        {{ $proker['proker_name'] }}</option>
                                    <?php
                                }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_name" class="col-md-2 col-form-label">Nama Kegiatan <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="kegiatan_name" id="kegiatan_name"
                                    value="{{ $kegiatan['kegiatan_name'] }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_tanggal" class="col-md-2 col-form-label">Tanggal Kegiatan <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="kegiatan_tanggal" id="kegiatan_tanggal"
                                    value="{{ $kegiatan['kegiatan_tanggal'] }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_nominal" class="col-md-2 col-form-label">Nominal Kegiatan<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control format-number" name="kegiatan_nominal"
                                    id="kegiatan_nominal"
                                    value="{{ number_format($kegiatan['kegiatan_nominal'], 0, ',', '.') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_deskripsi" class="col-md-2 col-form-label">Deskripsi <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea name="kegiatan_deskripsi" id="kegiatan_deskripsi" cols="30" rows="10" class="form-control" required>{{ $kegiatan['kegiatan_deskripsi'] }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_isActive" class="col-md-2 col-form-label">Lampiran </label>
                            <div class="col-md-6">
                                <?php
                                    if($kegiatan['kegiatan_lampiran'] != '-'){
                                        $fileUrl = Storage::url('lampiran/' . $kegiatan['kegiatan_lampiran']);
                                ?>
                                <a href="{{ $fileUrl }}" class="btn btn-success mb-1" download>Unduh Lampiran</a>
                                <?php
                                    }
                                ?>
                                <input type="file" name="kegiatan_lampiran" id="kegiatan_lampiran" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-secondary float-start"
                                    href="{{ route('master.kegiatan.index') }}">Kembali</a>
                                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Hapus</button>
                                <button class="btn btn-primary btn-md float-end mx-2" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kegiatan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <strong>Apakah Anda yakin ingin menghapus data kegiatan ini?</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('master.kegiatan.aksi.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan['kegiatan_id'] }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
