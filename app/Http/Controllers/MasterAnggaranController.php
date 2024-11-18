<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Helpers\Flasher;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\AnggaranProker;

class MasterAnggaranController extends Controller
{
    public function index_anggaran()
    {
        $data = [];
        $data['title'] = 'Daftar Anggaran';
        $data['page_title'] = 'Daftar Anggaran';
        $data['page_subtitle'] = 'Berikut ini adalah daftar anggaran yang terdaftar pada sistem';
        $data['sidebar'] = 'anggaran';
        $data['anggarans'] = Anggaran::get();
        $data['breadcrumb'] = [
            '#' => 'Daftar Anggaran'
        ];
        return view('staff.master.anggaran.index', $data);
    }
    public function add_anggaran()
    {
        $data = [];
        $data['title'] = 'Tambah Anggaran';
        $data['page_title'] = 'Tambah Anggaran';
        $data['page_subtitle'] = 'Silakan lengkapi data anggaran baru';
        $data['sidebar'] = 'anggaran';
        $data['breadcrumb'] = [
            '/staff/master/anggaran' => 'Daftar Anggaran',
            '#' => 'Tambah Baru'
        ];
        return view('staff.master.anggaran.add', $data);
    }
    public function edit_anggaran($anggaran_id)
    {
        $anggaran = Anggaran::where('anggaran_id', $anggaran_id)->first();
        if ($anggaran) {
            $data = [];
            $data['title'] = 'Ubah Anggaran';
            $data['page_title'] = 'Ubah Anggaran';
            $data['page_subtitle'] = 'Berikut ini adalah data anggaran';
            $data['sidebar'] = 'anggaran';
            $data['anggaran'] = $anggaran;
            $data['breadcrumb'] = [
                '/staff/master/anggaran' => 'Daftar Anggaran',
                '#' => 'Edit'
            ];
            return view('staff.master.anggaran.edit', $data);
        } else {
            Flasher::warning('Data anggaran tidak ditemukan');
            return redirect()->route('master.anggaran.index');
        }
    }
    public function aksi_add_anggaran(Request $request)
    {
        $temp = $request->all();
        $anggaran = Anggaran::create($temp);
        if ($anggaran) {
            $prokers = Proker::where('proker_isActive', 1)->get();
            foreach ($prokers as $key => $proker) {
                AnggaranProker::create([
                    'anggaran_id' => $anggaran->anggaran_id,
                    'proker_id' => $proker['proker_id'],
                    'anggaran_proker_nominal' => 0,
                ]);
            }
            Flasher::success('Data anggaran berhasil dibuat');
            return redirect()->route('master.anggaran.edit', ['anggaran_id' => $anggaran->anggaran_id]);
        } else {
            Flasher::danger('Data anggaran gagal dibuat');
            return redirect()->route('master.anggaran.index');
        }
    }
    public function aksi_edit_anggaran(Request $request)
    {
        $temp = $request->all();
        $anggaran = Anggaran::where('anggaran_id', $temp['anggaran_id'])->first();
        if ($anggaran) {
            $anggaran->anggaran_name = $temp['anggaran_name'];
            //$anggaran->anggaran_nominal = $temp['anggaran_nominal'];
            $anggaran->anggaran_deskripsi = $temp['anggaran_deskripsi'];
            $anggaran->anggaran_isActive = $temp['anggaran_isActive'];
            if ($anggaran->save()) {
                Flasher::success('Data anggaran berhasil diupdate');
            } else {
                Flasher::success('Data anggaran gagal diupdate');
            }
            return redirect()->route('master.anggaran.edit', ['anggaran_id' => $anggaran->anggaran_id]);
        } else {
            Flasher::warning('Data anggaran tidak ditemukan');
            return redirect()->route('master.anggaran.index');
        }
    }
    public function aksi_delete_anggaran(Request $request)
    {
        $temp = $request->all();
        $anggaran_id = $temp['anggaran_id'];
        $anggaran = Anggaran::where('anggaran_id', $anggaran_id)->first();

        if ($anggaran) {
            try {
                if ($anggaran->delete()) {
                    Flasher::success('Data anggaran berhasil dihapus');
                } else {
                    Flasher::warning('Data anggaran gagal dihapus');
                    return redirect()->route('master.anggaran.edit', ['anggaran_id' => $anggaran_id]);
                }
            } catch (\Exception $e) {
                Flasher::danger('Data anggaran tidak dapat dihapus karena terkait dengan data lain.');
                return redirect()->route('master.anggaran.edit', ['anggaran_id' => $anggaran_id]);
            }
        } else {
            Flasher::danger('Data anggaran tidak ditemukan');
        }

        return redirect()->route('master.anggaran.index');
    }

    public function aksi_edit_anggaran_proker(Request $request)
    {
        $temp = $request->all();
        $anggaran_proker = AnggaranProker::find($temp['anggaran_proker_id']);
        if ($anggaran_proker) {
            $anggaran_proker->anggaran_proker_nominal = $temp['anggaran_proker_nominal'];
            $save = $anggaran_proker->save();
            if ($save) {
                Flasher::success('Data Anggaran Proker berhasil diperbaharui');
            } else {
                Flasher::warning('Data Anggaran Proker gagal diperbaharui');
            }
        } else {
            Flasher::warning('Data Anggaran Proker tidak ditemukan');
        }
        return redirect()->route('master.anggaran.edit', ['anggaran_id' => $temp['anggaran_id']]);
    }
}
