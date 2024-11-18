@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.kegiatan.aksi.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="anggaran_id" class="col-md-2 col-form-label">Nama Anggaran<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="anggaran_id" id="anggaran_id"
                                    value="{{ $anggaran['anggaran_id'] }}">
                                <input type="text" class="form-control" value="{{ $anggaran['anggaran_name'] }}"
                                    disabled>
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
                                    <option value="{{ $proker['proker_id'] }}">{{ $proker['proker_name'] }}</option>
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
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_tanggal" class="col-md-2 col-form-label">Tanggal Kegiatan <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="kegiatan_tanggal" id="kegiatan_tanggal"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_nominal" class="col-md-2 col-form-label">Nominal Kegiatan<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control format-number" name="kegiatan_nominal" id="kegiatan_nominal" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_deskripsi" class="col-md-2 col-form-label">Deskripsi <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea name="kegiatan_deskripsi" id="kegiatan_deskripsi" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan_lampiran" class="col-md-2 col-form-label">Lampiran <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="file" name="kegiatan_lampiran" id="kegiatan_lampiran" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <button class="btn btn-primary btn-md float-end" type="submit">Simpan</button>
                                <a class="btn btn-secondary" href="{{ route('master.kegiatan.index') }}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
