@extends('layout.user')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.profile.aksi.update') }}" method="POST">
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
                                <select name="role" id="role" class="form-select" disabled>
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
                                <button class="btn btn-primary btn-md float-end mx-2" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
