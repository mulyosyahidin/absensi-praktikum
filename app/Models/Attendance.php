<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function attendanceMeeting()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function meetings()
    {
        return $this->hasMany(AttendanceMeeting::class, 'attendance_id', 'id');
    }
}
