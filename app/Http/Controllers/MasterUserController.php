<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Flasher;
use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    public function index_user()
    {
        $data = [];
        $data['title'] = 'Daftar User';
        $data['sidebar'] = 'user';
        $data['page_title'] = 'Daftar User';
        $data['page_subtitle'] = 'Berikut ini adalah daftar user yang terdaftar pada sistem';
        $data['breadcrumb'] = [
            '#' => 'Daftar User'
        ];
        $data['users'] = User::get();
        return view('staff.master.user.index', $data);
    }

    public function add_user()
    {
        $data = [];
        $data['title'] = 'Tambah User';
        $data['sidebar'] = 'user';
        $data['page_title'] = 'Tambah User';
        $data['page_subtitle'] = 'Silakan lengkapi data user baru';
        $data['breadcrumb'] = [
            '/staff/master/user' => 'Daftar User',
            '#' => 'Tambah Baru'
        ];
        return view('staff.master.user.add', $data);
    }

    public function edit_user($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        if ($user) {
            $data = [];
            $data['title'] = 'Ubah User';
            $data['sidebar'] = 'user';
            $data['page_title'] = 'Ubah User';
            $data['page_subtitle'] = 'Berikut ini adalah data user';
            $data['user'] = $user;
            $data['breadcrumb'] = [
                '/staff/master/user' => 'Daftar User',
                '#' => 'Edit'
            ];
            return view('staff.master.user.edit', $data);
        } else {
            Flasher::warning('Data user tidak ditemukan');
            return redirect()->route('master.user.index');
        }
    }

    public function aksi_add_user(Request $request)
    {
        $temp = $request->all();
        $payloadUser = [
            'username' => $temp['username'],
            'fullname' => $temp['fullname'],
            'role' => $temp['role'],
            'password' => password_hash($temp['password'], PASSWORD_BCRYPT)
        ];
        $user = User::create($payloadUser);
        if ($user) {
            Flasher::success('User berhasil dibuat');
            return redirect()->route('master.user.edit', ['user_id' => $user->user_id]);
        } else {
            Flasher::warning('User gagal dibuat, silakan coba lagi');
            return redirect()->route('master.user.index');
        }
    }

    public function aksi_edit_user(Request $request)
    {
        $temp = $request->all();
        $user = User::where('user_id', $temp['user_id'])->first();
        if ($user) {
            $user->fullname = $temp['fullname'];
            $user->role = $temp['role'];
            $user->password = !empty(trim($temp['password'])) ? password_hash($temp['password'], PASSWORD_BCRYPT) : $user->password;
            $update = $user->save();
            if ($update) {
                Flasher::success('User berhasil diupdate');
            } else {
                Flasher::success('User gagal diupdate');
            }
            return redirect()->route('master.user.edit', ['user_id' => $user->user_id]);
        } else {
            Flasher::warning('User tidak ditemukan');
            return redirect()->route('master.user.index');
        }
    }

    public function aksi_delete_user(Request $request)
    {
        $temp = $request->all();
        $user_id = $temp['user_id'];
        $user = User::where('user_id', $user_id)->first();

        if ($user) {
            try {
                if ($user->delete()) {
                    Flasher::success('User berhasil dihapus');
                } else {
                    Flasher::warning('User gagal dihapus');
                    return redirect()->route('master.user.edit', ['user_id' => $user_id]);
                }
            } catch (\Exception $e) {
                Flasher::danger('User tidak dapat dihapus karena terkait dengan data lain.');
                return redirect()->route('master.user.edit', ['user_id' => $user_id]);
            }
        } else {
            Flasher::danger('User tidak ditemukan');
        }

        return redirect()->route('master.user.index');
    }
}
