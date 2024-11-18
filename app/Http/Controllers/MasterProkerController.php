<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Helpers\Flasher;
use Illuminate\Http\Request;

class MasterProkerController extends Controller
{
    public function index_proker()
    {
        $data = [];
        $data['title'] = 'Daftar Proker';
        $data['page_title'] = 'Daftar Proker';
        $data['page_subtitle'] = 'Berikut ini adalah daftar proker yang terdaftar pada sistem';
        $data['sidebar'] = 'proker';
        $data['prokers'] = Proker::get();
        $data['breadcrumb'] = [
            '#' => 'Daftar Proker'
        ];
        return view('staff.master.proker.index', $data);
    }
    public function add_proker()
    {
        $data = [];
        $data['title'] = 'Tambah Proker';
        $data['page_title'] = 'Tambah Proker';
        $data['page_subtitle'] = 'Silakan lengkapi data proker baru';
        $data['sidebar'] = 'proker';
        $data['breadcrumb'] = [
            '/staff/master/proker' => 'Daftar Proker',
            '#' => 'Edit'
        ];
        return view('staff.master.proker.add', $data);
    }
    public function edit_proker($proker_id)
    {
        $proker = Proker::where('proker_id', $proker_id)->first();
        if ($proker) {
            $data = [];
            $data['title'] = 'Ubah Proker';
            $data['page_title'] = 'Ubah Proker';
            $data['page_subtitle'] = 'Berikut ini adalah data proker';
            $data['sidebar'] = 'proker';
            $data['proker'] = $proker;
            $data['breadcrumb'] = [
                '/staff/master/proker' => 'Daftar Proker',
                '#' => 'Edit'
            ];
            return view('staff.master.proker.edit', $data);
        } else {
            Flasher::warning('Data proker tidak ditemukan');
            return redirect()->route('master.proker.index');
        }
    }
    public function aksi_add_proker(Request $request)
    {
        $temp = $request->all();
        $proker = Proker::create($temp);
        if ($proker) {
            Flasher::success('Data proker berhasil dibuat');
            return redirect()->route('master.proker.edit', ['proker_id' => $proker->proker_id]);
        } else {
            Flasher::danger('Data proker gagal dibuat');
            return redirect()->route('master.proker.index');
        }
    }
    public function aksi_edit_proker(Request $request)
    {
        $temp = $request->all();
        $proker = Proker::where('proker_id', $temp['proker_id'])->first();
        if ($proker) {
            $proker->proker_name = $temp['proker_name'];
            $proker->proker_tujuan = $temp['proker_tujuan'];
            $proker->proker_sasaran = $temp['proker_sasaran'];
            $proker->proker_deskripsi = $temp['proker_deskripsi'];
            $proker->proker_isActive = $temp['proker_isActive'];
            if ($proker->save()) {
                Flasher::success('Data proker berhasil diupdate');
            } else {
                Flasher::success('Data proker gagal diupdate');
            }
            return redirect()->route('master.proker.edit', ['proker_id' => $proker->proker_id]);
        } else {
            Flasher::warning('Data proker tidak ditemukan');
            return redirect()->route('master.proker.index');
        }
    }
    public function aksi_delete_proker(Request $request)
    {
        $temp = $request->all();
        $proker_id = $temp['proker_id'];
        $proker = Proker::where('proker_id', $proker_id)->first();

        if ($proker) {
            try {
                if ($proker->delete()) {
                    Flasher::success('Data proker berhasil dihapus');
                } else {
                    Flasher::warning('Data proker gagal dihapus');
                    return redirect()->route('master.proker.edit', ['proker_id' => $proker_id]);
                }
            } catch (\Exception $e) {
                Flasher::danger('Data proker tidak dapat dihapus karena terkait dengan data lain.');
                return redirect()->route('master.proker.edit', ['proker_id' => $proker_id]);
            }
        } else {
            Flasher::danger('Data proker tidak ditemukan');
        }

        return redirect()->route('master.proker.index');
    }
}
