<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Proker;
use App\Models\Anggaran;
use App\Models\AnggaranProker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = array(
            array(
                'username' => 'user',
                'fullname' => 'User 1',
                'role' => 1,
                'password' => password_hash('user', PASSWORD_BCRYPT),
            ),
            array(
                'username' => 'admin',
                'fullname' => 'Admin 1',
                'role' => 9,
                'password' => password_hash('admin', PASSWORD_BCRYPT),
            ),
        );
        foreach ($users as $user) {
            User::create($user);
        }

        Anggaran::create([
            'anggaran_name' => 'Anggaran 2024',
            'anggaran_deskripsi' => 'Anggaran kegiatan bidang Didaktos pada tahun 2024',
            'anggaran_isActive' => 1,
        ]);

        $prokers = [
            [
                'proker_name' => 'Dana Pelayanan Diakonia',
                'proker_tujuan' => 'Pelayanan Kasih',
                'proker_sasaran' => 'Warga jemaat yang sakit dan berduka',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Pemberian bingkisan kasih bagi janda duda, anak yatimpiatu dan pelayan Firman dalam jemaat',
                'proker_tujuan' => 'Memberikan pelayanan sebagai wujud kasih',
                'proker_sasaran' => 'Warga jemaat dalam pelayan Firman',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Pelayanan Pastoral konseling terkait Kesehatan',
                'proker_tujuan' => 'Dukungan pelayanan kesehatan',
                'proker_sasaran' => 'Warga jemaat yang membutuhkan',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Senam lansia',
                'proker_tujuan' => 'Dukungan pelayanan',
                'proker_sasaran' => 'Warga jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Bantuan bagi warga jemaat yang mengalami bencana',
                'proker_tujuan' => 'Memberikan pelayanan kepada jemaat yang mengalami bencana',
                'proker_sasaran' => 'Warga jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Rehat Rumah',
                'proker_tujuan' => 'Memberikan pelayanan sebagai wujud kasih',
                'proker_sasaran' => 'Warga jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Pelayanan Posyandu Lansia bersama kader posyandu',
                'proker_tujuan' => 'Memberikan pelayan kepada warga jemaat',
                'proker_sasaran' => 'Warga Jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Pengobatan massal bagi jemaat Efrata Wosi dan Jemaat Pinggiran',
                'proker_tujuan' => 'Memberikan pelayanan bagi jemaat Efrata Wosi dan jemaat pinggiran',
                'proker_sasaran' => 'Warga Jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
            [
                'proker_name' => 'Pembentukan TIM tanggap Bencana',
                'proker_tujuan' => 'Memberikan pelayanan',
                'proker_sasaran' => 'Warga jemaat',
                'proker_deskripsi' => '-',
                'proker_isActive' => 1,
            ],
        ];
        foreach ($prokers as $key => $proker) {
            Proker::create($proker);
            AnggaranProker::create([
                'anggaran_id' => 1,
                'proker_id' => $key + 1,
                'anggaran_proker_nominal' => rand(1000000, 10000000),
            ]);
        }
    }
}
