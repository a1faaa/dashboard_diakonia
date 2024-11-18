<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Helpers\Flasher;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UserKegiatanController extends Controller
{
    public function index_kegiatan()
    {
        $data = [];
        $data['title'] = 'Daftar Kegiatan';
        $data['page_title'] = 'Daftar Kegiatan';
        $data['sidebar'] = 'kegiatan';
        $anggaran = Anggaran::where('anggaran_isActive', 1)->first();
        if($anggaran){
            $data['kegiatans'] = Kegiatan::where('anggaran_id', $anggaran['anggaran_id'])->get();
            $data['page_subtitle'] = 'Berikut ini adalah daftar kegiatan yang terdaftar pada sistem pada tahun anggaran ' . $anggaran['anggaran_name'];
        }else{
            $data['kegiatans'] = [];
            $data['page_subtitle'] = 'Berikut ini adalah daftar kegiatan yang terdaftar pada sistem pada tahun anggaran (tidak ada tahun anggaran aktif)';
            Flasher::warning('Silakan aktifkan salah satu tahun anggaran terlebih dahulu');
        }
        $data['breadcrumb'] = [
            '#' => 'Daftar Kegiatan'
        ];
        return view('user.kegiatan.index', $data);
    }
    public function filter_kegiatan($proker_id)
    {
        $data = [];
        $data['title'] = 'Daftar Kegiatan';
        $data['page_title'] = 'Daftar Kegiatan';
        $data['sidebar'] = 'kegiatan';
        $anggaran = Anggaran::where('anggaran_isActive', 1)->first();
        if($anggaran){
            $proker = Proker::find($proker_id);
            if($proker){
                $data['kegiatans'] = Kegiatan::where('anggaran_id', $anggaran['anggaran_id'])->where('proker_id', $proker_id)->get();
                $data['page_subtitle'] = 'Berikut ini adalah daftar kegiatan yang terdaftar pada sistem pada tahun anggaran ' . $anggaran['anggaran_name'] . ' untuk ' . $proker['proker_name'];
            }else{
                $data['kegiatans'] = [];
                $data['page_subtitle'] = 'Berikut ini adalah daftar kegiatan yang terdaftar pada sistem pada tahun anggaran (tidak ada tahun anggaran aktif)';
                Flasher::danger('Proker tidak ditemukan');
            }
        }else{
            $data['kegiatans'] = [];
            $data['page_subtitle'] = 'Berikut ini adalah daftar kegiatan yang terdaftar pada sistem pada tahun anggaran (tidak ada tahun anggaran aktif)';
            Flasher::warning('Silakan aktifkan salah satu tahun anggaran terlebih dahulu');
        }
        $data['breadcrumb'] = [
            '#' => 'Daftar Kegiatan'
        ];
        return view('user.kegiatan.filter', $data);
    }

    public function view_filter_kegiatan($kegiatan_id){
        $kegiatan = Kegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($kegiatan) {
            $data = [];
            $data['title'] = 'Detail Kegiatan';
            $data['page_title'] = 'Detail Kegiatan';
            $data['page_subtitle'] = 'Berikut ini adalah data kegiatan';
            $data['sidebar'] = 'kegiatan';
            $data['kegiatan'] = $kegiatan;
            $data['prokers'] = Proker::where('proker_isActive', 1)->orderBy('proker_name', 'ASC')->get();
            $data['breadcrumb'] = [
                '/user/kegiatan' => 'Daftar Kegiatan',
                '#' => 'Edit'
            ];
            return view('user.kegiatan.view-filter', $data);
        } else {
            Flasher::warning('Data kegiatan tidak ditemukan');
            return redirect()->route('master.kegiatan.index');
        }
    }

    public function view_kegiatan($kegiatan_id){
        $kegiatan = Kegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($kegiatan) {
            $data = [];
            $data['title'] = 'Detail Kegiatan';
            $data['page_title'] = 'Detail Kegiatan';
            $data['page_subtitle'] = 'Berikut ini adalah data kegiatan';
            $data['sidebar'] = 'kegiatan';
            $data['kegiatan'] = $kegiatan;
            $data['prokers'] = Proker::where('proker_isActive', 1)->orderBy('proker_name', 'ASC')->get();
            $data['breadcrumb'] = [
                '/user/kegiatan' => 'Daftar Kegiatan',
                '#' => 'Edit'
            ];
            return view('user.kegiatan.view', $data);
        } else {
            Flasher::warning('Data kegiatan tidak ditemukan');
            return redirect()->route('master.kegiatan.index');
        }
    }

    public function print_kegiatan(){
        $anggaran = Anggaran::where('anggaran_isActive', 1)->first();
        if($anggaran){
            $kegiatans = Kegiatan::where('anggaran_id', $anggaran['anggaran_id'])->orderBy('kegiatan_tanggal', 'ASC')->get();
        }else{
            $kegiatans = [];
        }
        $pdf = PDF::loadView('pdf.kegiatan_report', compact('kegiatans'));
        return $pdf->download('kegiatan_report.pdf');
    }
}
