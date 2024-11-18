@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.proker.aksi.edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="proker_id" value="{{ $proker['proker_id'] }}">
                        <div class="row mb-3">
                            <label for="proker_name" class="col-md-2 col-form-label">Nama Proker <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="proker_name" id="proker_name" value="{{ $proker['proker_name'] }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proker_tujuan" class="col-md-2 col-form-label">Tujuan <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="proker_tujuan" id="proker_tujuan" value="{{ $proker['proker_tujuan'] }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proker_sasaran" class="col-md-2 col-form-label">Sasaran <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="proker_sasaran" id="proker_sasaran"
                                    value="{{ $proker['proker_sasaran'] }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proker_deskripsi" class="col-md-2 col-form-label">Deskripsi <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <textarea name="proker_deskripsi" id="proker_deskripsi" cols="30" rows="10" class="form-control" required>{{ $proker['proker_deskripsi'] }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proker_isActive" class="col-md-2 col-form-label">Status <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select name="proker_isActive" id="proker_isActive" class="form-select" required>
                                    <option value="1" {{ $proker['proker_isActive'] == 1? 'selected': '' }}>Aktif</option>
                                    <option value="0" {{ $proker['proker_isActive'] == 0? 'selected': '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-secondary float-start"
                                    href="{{ route('master.proker.index') }}">Kembali</a>
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
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Proker
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <strong>Apakah Anda yakin ingin menghapus data proker ini?</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('master.proker.aksi.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="proker_id" value="{{ $proker['proker_id'] }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
