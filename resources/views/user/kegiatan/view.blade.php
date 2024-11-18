@extends('layout.user')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="anggaran_id" class="col-md-2 col-form-label">Nama Anggaran<span
                                class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" name="anggaran_id" id="anggaran_id"
                                value="{{ $kegiatan->anggaran['anggaran_id'] }}">
                            <input type="text" class="form-control" value="{{ $kegiatan->anggaran['anggaran_name'] }}"
                                disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="proker_id" class="col-md-2 col-form-label">Nama Proker <span
                                class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <select name="proker_id" id="proker_id" class="form-select" disabled>
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
                                value="{{ $kegiatan['kegiatan_name'] }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kegiatan_tanggal" class="col-md-2 col-form-label">Tanggal Kegiatan <span
                                class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="date" class="form-control" name="kegiatan_tanggal" id="kegiatan_tanggal"
                                value="{{ $kegiatan['kegiatan_tanggal'] }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kegiatan_nominal" class="col-md-2 col-form-label">Nominal Kegiatan<span
                                class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="kegiatan_nominal" id="kegiatan_nominal"
                                step="1" min="0" value="{{ number_format($kegiatan['kegiatan_nominal'], 0, ',', '.') }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kegiatan_deskripsi" class="col-md-2 col-form-label">Deskripsi <span
                                class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <textarea name="kegiatan_deskripsi" id="kegiatan_deskripsi" cols="30" rows="10" class="form-control" disabled>{{ $kegiatan['kegiatan_deskripsi'] }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kegiatan_isActive" class="col-md-2 col-form-label">Lampiran </label>
                        <div class="col-md-6">
                            <?php
                                    if($kegiatan['kegiatan_lampiran'] != '-'){
                                        $fileUrl = Storage::url('lampiran/' . $kegiatan['kegiatan_lampiran']);
                                ?>
                            <a href="{{ $fileUrl }}" class="btn btn-success mb-1" download>Download</a>
                            <?php
                                    }
                                ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="btn btn-secondary float-start" href="{{ route('user.kegiatan.index') }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
