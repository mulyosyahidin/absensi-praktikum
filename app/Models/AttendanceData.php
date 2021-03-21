<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceData extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function meeting()
    {
        return $this->hasOne(AttendanceMeeting::class, 'id', 'meeting_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function status()
    {
        return $this->hasOne(AttendanceStatus::class);
    }
}
