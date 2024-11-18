@extends('layout.staff')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.user.aksi.edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                        <div class="row mb-3">
                            <label for="username" class="col-md-2 col-form-label">Username <span
                                    class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="username" id="username"
                                    value="<?= $user['username'] ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fullname" class="col-md-2 col-form-label">Fullname <span
                                    class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="fullname" id="fullname"
                                    value="<?= $user['fullname'] ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-md-2 col-form-label">Role <span
                                    class="text-danger">*<span></label>
                            <div class="col-md-4">
                                <select name="role" id="role" class="form-select" required>
                                    <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>User</option>
                                    <option value="9" <?= $user['role'] == 9 ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="password" id="password">
                                <p class="text-muted">Silakan kosongi jika tidak ingin mengubah password user</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-secondary float-start"
                                    href="{{ route('master.user.index') }}">Kembali</a>
                                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Delete</button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <strong>Apakah Anda yakin ingin menghapus data user ini?</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('master.user.aksi.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
