@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.user.aksi.add') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="username" class="col-md-2 col-form-label">Username <span class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fullname" class="col-md-2 col-form-label">Fullname <span class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="fullname" id="fullname" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-md-2 col-form-label">Role <span class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <select name="role" id="role" class="form-select" required>
                                    <option value="1">User</option>
                                    <option value="9">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-2 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <button class="btn btn-primary btn-md float-end" type="submit">Simpan</button>
                                <a class="btn btn-secondary" href="{{ route('master.user.index') }}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
