@extends('layout.staff')
@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('master.proker.aksi.add') }}" method="POST">
                    @csrf
                   <div class="row mb-3">
                       <label for="proker_name" class="col-md-2 col-form-label">Nama Proker <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                           <input type="text" class="form-control" name="proker_name" id="proker_name" required>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="proker_tujuan" class="col-md-2 col-form-label">Tujuan <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                           <input type="text" class="form-control" name="proker_tujuan" id="proker_tujuan" required>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="proker_sasaran" class="col-md-2 col-form-label">Sasaran <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                           <input type="text" class="form-control" name="proker_sasaran" id="proker_sasaran" required>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="proker_deskripsi" class="col-md-2 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                        <textarea name="proker_deskripsi" id="proker_deskripsi" cols="30" rows="10" class="form-control" required></textarea>
                       </div>
                   </div>
                   <div class="row mb-3">
                       <label for="proker_isActive" class="col-md-2 col-form-label">Status <span class="text-danger">*</span></label>
                       <div class="col-md-4">
                        <select name="proker_isActive" id="proker_isActive" class="form-select" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                       </div>
                   </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button class="btn btn-primary btn-md float-end" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('master.proker.index') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
