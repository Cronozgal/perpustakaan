<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Default
        User::create([
            'role' => 'admin',
            'nama_anggota' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Siswa Default
        User::create([
            'role' => 'siswa',
            'nis' => '1001',
            'nama_anggota' => 'Budi Santoso',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'username' => 'budi',
            'password' => bcrypt('siswa123'),
        ]);
    }
}
