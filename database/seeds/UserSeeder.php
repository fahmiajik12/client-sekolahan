<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nama' => 'Admin',
            'type' => 'admin',
            'username' => 'masray',
            'password' => Hash::make('qwe123')
        ]);

        $user = User::create([
            'nama' => 'Dr. Resa',
            'type' => 'dokter',
            'username' => 'vivin',
            'password' => Hash::make('qwe123')
        ]);

        $user = User::create([
            'nama' => 'Yudi',
            'type' => 'pasien',
            'username' => 'yudi',
            'password' => Hash::make('qwe123')
        ]);
    }
}
