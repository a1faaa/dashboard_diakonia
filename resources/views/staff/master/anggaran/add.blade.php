@extends('layout.staff')
@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('master.anggaran.aksi.add') }}" method="POST">
                    @csrf
                   <div class="row mb-3">
                       <label for="anggaran_name" class="col-md-2 col-form-label">Nama Anggaran <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                           <input type="text" class="form-control" name="anggaran_name" id="anggaran_name" required>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="anggaran_deskripsi" class="col-md-2 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                        <textarea name="anggaran_deskripsi" id="anggaran_deskripsi" cols="30" rows="10" class="form-control" required></textarea>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="anggaran_isActive" class="col-md-2 col-form-label">Status <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                        <select name="anggaran_isActive" id="anggaran_isActive" class="form-select" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                       </div>
                   </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button class="btn btn-primary btn-md float-end" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('master.anggaran.index') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
