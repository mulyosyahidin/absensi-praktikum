<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceMeeting extends Model
{
    use HasFactory;

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'id', 'attendance_id');
    }

    public function meetingData()
    {
        return $this->belongsTo(AttendanceData::class);
    }
}
