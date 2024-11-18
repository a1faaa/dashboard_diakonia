<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Helpers\Flasher;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MasterKegiatanController extends Controller
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
        return view('staff.kegiatan.index', $data);
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
        return view('staff.kegiatan.filter', $data);
    }
    public function view_kegiatan($kegiatan_id)
    {
        $kegiatan = Kegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($kegiatan) {
            $data = [];
            $data['title'] = 'Ubah Kegiatan';
            $data['page_title'] = 'Ubah Kegiatan';
            $data['page_subtitle'] = 'Berikut ini adalah data kegiatan';
            $data['sidebar'] = 'kegiatan';
            $data['kegiatan'] = $kegiatan;
            $data['prokers'] = Proker::where('proker_isActive', 1)->orderBy('proker_name', 'ASC')->get();
            $data['breadcrumb'] = [
                '/staff/kegiatan' => 'Daftar Kegiatan',
                '#' => 'Edit'
            ];
            return view('staff.kegiatan.view', $data);
        } else {
            Flasher::warning('Data kegiatan tidak ditemukan');
            return redirect()->route('master.kegiatan.filter');
        }
    }
    public function add_kegiatan()
    {
        $data = [];
        $data['title'] = 'Tambah Kegiatan';
        $data['page_title'] = 'Tambah Kegiatan';
        $data['page_subtitle'] = 'Silakan lengkapi data kegiatan baru';
        $data['sidebar'] = 'kegiatan';
        $data['anggaran'] = Anggaran::where('anggaran_isActive', 1)->first();
        $data['prokers'] = Proker::where('proker_isActive', 1)->orderBy('proker_name', 'ASC')->get();
        $data['breadcrumb'] = [
            '/staff/kegiatan' => 'Daftar Kegiatan',
            '#' => 'Tambah Baru'
        ];
        return view('staff.kegiatan.add', $data);
    }
    public function edit_kegiatan($kegiatan_id)
    {
        $kegiatan = Kegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($kegiatan) {
            $data = [];
            $data['title'] = 'Ubah Kegiatan';
            $data['page_title'] = 'Ubah Kegiatan';
            $data['page_subtitle'] = 'Berikut ini adalah data kegiatan';
            $data['sidebar'] = 'kegiatan';
            $data['kegiatan'] = $kegiatan;
            $data['prokers'] = Proker::where('proker_isActive', 1)->orderBy('proker_name', 'ASC')->get();
            $data['breadcrumb'] = [
                '/staff/kegiatan' => 'Daftar Kegiatan',
                '#' => 'Edit'
            ];
            return view('staff.kegiatan.edit', $data);
        } else {
            Flasher::warning('Data kegiatan tidak ditemukan');
            return redirect()->route('master.kegiatan.index');
        }
    }
    public function aksi_add_kegiatan(Request $request)
    {
        // Validate the incoming request data, specifically for the file
        // $request->validate([
        //     'kegiatan_lampiran' => 'file|mimes:jpg,png,pdf,docx|max:2048',
        //     // Add other validation rules as necessary
        // ]);
    
        // 1. Check if the request contains a file
        if (!$request->hasFile('kegiatan_lampiran')) {
            Flasher::warning('Data kegiatan gagal dibuat karena lampiran tidak ada');
            return redirect()->route('master.kegiatan.add');
        }
    
        // 2. Handle the file upload
        $file = $request->file('kegiatan_lampiran');
        $fileName = '-';
    
        if ($file) {
            try {
                // Generate a unique name for the file
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                
                // Store the file in the 'lampiran' directory under 'public' disk
                $file->storeAs('lampiran', $fileName, 'public');
            } catch (\Exception $e) {
                // Log the exception or handle it as necessary
                // For now, if upload fails, we set the file name as '-'
                $fileName = '-';
            }
        }
    
        // 3. Store the file name in the $temp array before creating the Kegiatan
        $temp = $request->all();
        $temp['kegiatan_lampiran'] = $fileName;
        $temp['user_id'] = auth()->user()->user_id;
    
        // Create the Kegiatan record in the database
        $kegiatan = Kegiatan::create($temp);
    
        // Check if the record was successfully created and redirect accordingly
        if ($kegiatan) {
            Flasher::success('Data kegiatan berhasil dibuat');
            return redirect()->route('master.kegiatan.edit', ['kegiatan_id' => $kegiatan->kegiatan_id]);
        } else {
            Flasher::danger('Data kegiatan gagal dibuat');
            return redirect()->route('master.kegiatan.index');
        }
    }
    public function aksi_edit_kegiatan(Request $request)
    {
        $temp = $request->all();
        $kegiatan = Kegiatan::where('kegiatan_id', $temp['kegiatan_id'])->first();
    
        if ($kegiatan) {
            $kegiatan->kegiatan_name = $temp['kegiatan_name'];
            // $kegiatan->anggaran_id = $temp['anggaran_id']; // skipped since it can't be changed
            $kegiatan->proker_id = $temp['proker_id'];
            $kegiatan->kegiatan_tanggal = $temp['kegiatan_tanggal'];
            $kegiatan->kegiatan_deskripsi = $temp['kegiatan_deskripsi'];
            $kegiatan->kegiatan_nominal = $temp['kegiatan_nominal'];
            // $kegiatan->user_id = $temp['user_id']; // skipped since it can't be changed
    
            // Handle the file upload
            if ($request->hasFile('kegiatan_lampiran')) {
                $file = $request->file('kegiatan_lampiran');
                try {
                    // Generate a unique name for the file
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
    
                    // Store the file in the 'lampiran' directory under 'public' disk
                    $file->storeAs('lampiran', $fileName, 'public');
    
                    // Update the kegiatan_lampiran with the new file name
                    $kegiatan->kegiatan_lampiran = $fileName;
                } catch (\Exception $e) {
                    // Handle the exception if needed
                    Flasher::danger('File upload failed, keeping the previous attachment.');
                }
            } else {
                // If no new file, keep the old one
                $kegiatan->kegiatan_lampiran = $kegiatan->kegiatan_lampiran;
            }
    
            // Save the changes
            if ($kegiatan->save()) {
                Flasher::success('Data kegiatan berhasil diupdate');
            } else {
                Flasher::danger('Data kegiatan gagal diupdate');
            }
    
            return redirect()->route('master.kegiatan.edit', ['kegiatan_id' => $kegiatan->kegiatan_id]);
        } else {
            Flasher::warning('Data kegiatan tidak ditemukan');
            return redirect()->route('master.kegiatan.index');
        }
    }
    public function aksi_delete_kegiatan(Request $request)
    {
        $temp = $request->all();
        $kegiatan_id = $temp['kegiatan_id'];
        $kegiatan = Kegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($kegiatan) {
            if ($kegiatan->delete()) {
                Flasher::success('Data kegiatan berhasil dihapus');
            } else {
                Flasher::warning('Data kegiatan gagal dihapus');
                return redirect()->route('master.kegiatan.edit', ['kegiatan_id' => $kegiatan_id]);
            }
        } else {
            Flasher::danger('Data kegiatan tidak ditemukan');
        }
        return redirect()->route('master.kegiatan.index');
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
