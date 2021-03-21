<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceMeeting;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $overview['student'] = Student::count();
        $overview['course'] = Course::count();
        $overview['attendance'] = Attendance::count();
        $overview['meeting'] = AttendanceMeeting::count();

        $attendances = Attendance::take(5)->get();

        return view('dashboard', compact('attendances', 'overview'));
    }
}
