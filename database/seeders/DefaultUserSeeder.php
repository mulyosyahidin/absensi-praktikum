<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            'name' => 'Admin Absensi',
            'email' => 'si.absensi@default.local',
            'password' => Hash::make('12345678'),
            'created_at' => date('Y-m-d H:I:s')
        ]);
    }
}
