<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_statuses')->insert([
            ['name' => 'Hadir', 'classes' => 'success'],
            ['name' => 'Izin', 'classes' => 'info'],
            ['name' => 'Sakit', 'classes' => 'warning'],
            ['name' => 'Tidak hadir', 'classes' => 'danger']
        ]);
    }
}
