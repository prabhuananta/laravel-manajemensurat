<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\GrupTujuanSeeder;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
$this->call([
        GrupTujuanSeeder::class,
    ]);

        User::factory()->create([
            'name' => 'I Putu Sekretaris',
            'email' => 'sekre@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'golongan' => 'Sekretaris',
            'jabatan' => 'Sekretaris Dinas Pendidikan Kepemudaan dan Olahraga Kota Denpasar',
        ]);
        User::factory()->create([
            'name' => 'Kabid A',
            'email' => 'kabida@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
            'golongan' => 'Kepala Bidang',
            'jabatan' => 'Kepala Bidang Pendidikan Anak Usia Dini Dinas Pendidikan Kepemudaan dan Olahraga Kota Denpasar',
        ]);
        User::factory()->create([
            'name' => 'Kabid B',
            'email' => 'kabidb@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
            'golongan' => 'Kepala Bidang',
            'jabatan' => 'Kepala Bidang Pendidikan Dasar Dinas Pendidikan Kepemudaan dan Olahraga Kota Denpasar',
        ]);
        User::factory()->create([
            'name' => 'I Komang Kepala Dinas',
            'email' => 'kadis@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
            'golongan' => 'Kepala Dinas',
            'jabatan' => 'Kepala Dinas Pendidikan Kepemudaan dan Olahraga Kota Denpasar',
        ]);
    }
}
