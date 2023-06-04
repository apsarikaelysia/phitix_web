<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Ayam;
use App\Models\Gaji;
use App\Models\Pakan;
use App\Models\Vaksin;
use App\Models\Distribusi;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Role::create([
            'nama' => 'Super Admin',
        ]);

        Role::create([
            'nama' => 'Admin',
        ]);

        User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 1,
        ]);

        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2,
        ]);

        Ayam::create([
            'tanggal_masuk' => null,
            'jumlah_masuk' => null,
            'harga_satuan' => null,
            'total_harga' => 0,
            'mati' => null,
            'total_ayam' => null,
        ]);

        Gaji::create([
            'tanggal' => null,
            'nama_karyawan' => null,
            'jabatan' => null,
            'gaji' => 0,

        ]);

        Pakan::create([
            'pembelian' => null,
            'jenis_pakan' => null,
            'stok_pakan' => null,
            'harga_kg' => null,
            'total_harga' => 0,
            'sisa_stok_pakan' => null,
        ]);

        Vaksin::create([
            'tanggal_ovk' => null,
            'next_ovk' => null,
            'jenis_ovk' => null,
            'jumlah_ayam' => null,
            'biaya_ovk' => null,
            'total_biaya' => 0,

        ]);

        Distribusi::create([
            'customer' => null,
            'tanggal' => null,
            'contact' => null,
            'total_ayam' => null,
            'harga_satuan' => null,
            'payment' => 0,
        ]);
    }
}