<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proker;
use App\Helpers\Flasher;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\AnggaranProker;

class StaffController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'Dashboard Admin';
        $data['sidebar'] = 'dashboard';
        $data['breadcrumb'] = [
            '#' => 'Dashboard Admin'
        ];
        $anggaran = Anggaran::where('anggaran_isActive', 1)->first();
        if ($anggaran) {
            $data['anggaran'] = $anggaran;

            $prokers = Proker::where('proker_isActive', 1)->get();
            $kegiatans = Kegiatan::where('anggaran_id', $anggaran['anggaran_id'])->get();
            $nominalPengeluaran = 0;
            $listProkers = [];
            foreach ($prokers as $key => $value) {
                $anggaran_proker = AnggaranProker::where('anggaran_id', $anggaran['anggaran_id'])->where('proker_id', $value['proker_id'])->first();
                if ($anggaran_proker) {
                    $anggaran_proker_nominal = $anggaran_proker['anggaran_proker_nominal'];
                } else {
                    $anggaran_proker_nominal = 0;
                }
                $listProkers[$value['proker_id']] = [
                    'proker_name' => $value['proker_name'],
                    'nominal' => 0,
                    'anggaran_proker_nominal' => $anggaran_proker_nominal
                ];
            }
            foreach ($kegiatans as $key => $value) {
                $nominalPengeluaran += $value['kegiatan_nominal'];
                if (array_key_exists($value['proker_id'], $listProkers)) {
                    $listProkers[$value['proker_id']]['nominal'] += $value['kegiatan_nominal'];
                }
            }

            foreach ($listProkers as $key => &$value) {
                // Calculate the percentage with two decimal places
                $value['percentage'] = round(($value['nominal'] / ($value['anggaran_proker_nominal'] == 0 ? 1 : $value['anggaran_proker_nominal'])) * 100, 2);

                if ($value['percentage'] >= 100) {
                    $value['color'] = 'cui-red'; // For >100%
                } elseif ($value['percentage'] >= 90) {
                    $value['color'] = 'cui-orange'; // For 90-99%
                } elseif ($value['percentage'] >= 85) {
                    $value['color'] = 'cui-yellow'; // For 85-90%
                } else {
                    $value['color'] = 'success'; // For anything below 85%
                }
            }

            $persentasiPengeluaran = $nominalPengeluaran / $anggaran->nominal() * 100;

            $data['total_pengeluaran'] = [
                'nominal' => $nominalPengeluaran,
                'persentase' => $persentasiPengeluaran
            ];
            $data['total_tersisa'] = [
                'nominal' => $anggaran->nominal() - $nominalPengeluaran,
                'persentase' => 100 - $persentasiPengeluaran
            ];
            $data['listProkers'] = $listProkers;
            $data['anggaran_nominal'] = $anggaran->nominal();
        } else {
            $prokers = Proker::where('proker_isActive', 1)->get();
            $listProkers = [];
            foreach ($prokers as $key => $value) {
                $listProkers[$value['proker_id']] = [
                    'proker_name' => $value['proker_name'],
                    'nominal' => 0,
                    'anggaran_proker_nominal' => 0
                ];
            }
            foreach ($listProkers as $key => &$value) {
                // Calculate the percentage with two decimal places
                $value['percentage'] = 0;

                if ($value['percentage'] >= 100) {
                    $value['color'] = 'cui-red'; // For >100%
                } elseif ($value['percentage'] >= 90) {
                    $value['color'] = 'cui-orange'; // For 90-99%
                } elseif ($value['percentage'] >= 85) {
                    $value['color'] = 'cui-yellow'; // For 85-90%
                } else {
                    $value['color'] = 'success'; // For anything below 85%
                }
            }
            $data['anggaran'] = [
                'anggaran_nominal' => 0
            ];
            $data['total_pengeluaran'] = [
                'nominal' => 0,
                'persentase' => 0
            ];
            $data['total_tersisa'] = [
                'nominal' => 0,
                'persentase' => 100
            ];
            $data['listProkers'] = $listProkers;
            $data['anggaran_nominal'] = 0;
        }

        $tahuns = Anggaran::with(['kegiatans', 'anggaranProker']) // Correct the relationship name to 'kegiatans'
            ->orderBy('anggaran_name', 'ASC')
            ->get();

        foreach ($tahuns as $tahun) {
            $tahun['realisasi'] = $tahun->kegiatans->sum('kegiatan_nominal');  // Use 'kegiatans' instead of 'kegiatan'
            $tahun['anggaran'] = $tahun->anggaranProker->sum('anggaran_proker_nominal');
        }

        $data['tahuns'] = $tahuns;
        return view('staff.index', $data);
    }

    public function profile()
    {
        $data = [];
        $data['title'] = 'Profile';
        $data['sidebar'] = 'dashboard';
        $data['breadcrumb'] = [
            '#' => 'Profile'
        ];
        $user_id = auth()->user()->user_id;
        $data['user'] = User::where('user_id', $user_id)->first();
        return view('staff.profile', $data);
    }

    public function aksi_update_profile(Request $request)
    {
        $temp = $request->all();
        $user = User::where('user_id', $temp['user_id'])->first();
        if ($user) {
            $user->fullname = $temp['fullname'];
            $user->password = !empty(trim($temp['password'])) ? password_hash($temp['password'], PASSWORD_BCRYPT) : $user->password;
            $update = $user->save();
            if ($update) {
                Flasher::success('User berhasil diupdate');
            } else {
                Flasher::success('User gagal diupdate');
            }
            return redirect()->route('staff.profile', ['user_id' => $user->user_id]);
        } else {
            Flasher::warning('User tidak ditemukan');
            return redirect()->route('staff.index');
        }
    }
}
