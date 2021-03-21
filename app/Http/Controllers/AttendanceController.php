<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceData;
use App\Models\AttendanceMeeting;
use App\Models\AttendanceStatus;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with('course')->paginate();

        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();

        return view('attendances.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'nullable|max:512'
        ]);

        $attendance = new Attendance();
        $attendance->course_id = $request->course_id;
        $attendance->name = $request->name;
        $attendance->description = $request->description;
        $attendance->save();

        return redirect()
            ->back()
            ->withSuccess('Berhasil membuat absensi baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $courses = Course::all();

        return view('attendances.edit', compact('attendance', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'course_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'nullable|max:512'
        ]);

        $attendance->course_id = $request->course_id;
        $attendance->name = $request->name;
        $attendance->description = $request->description;
        $attendance->save();

        return redirect()
            ->back()
            ->withSuccess('Berhasil memperbarui data absensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->withSuccess('Berhasil menghapus data absensi');
    }

    public function newMeeting(Attendance $attendance)
    {
        return view('attendances.new-meeting', compact('attendance'));
    }

    public function storeMeeting(Request $request, Attendance $attendance)
    {
        $request->validate([
            'meeting_number' => 'required|numeric',
            'date' => 'required',
            'description' => 'nullable|max:512'
        ]);

        $meeting = new AttendanceMeeting();
        $meeting->attendance_id = $attendance->id;
        $meeting->meeting_number = $request->meeting_number;
        $meeting->date = $request->date;
        $meeting->description = $request->description;
        $meeting->save();

        return redirect()
            ->route('attendances.meeting', $meeting->id);
    }

    public function meeting(AttendanceMeeting $meeting)
    {
        $statuses = AttendanceStatus::all();
        $students = Student::all();

        return view('attendances.meeting', compact('meeting', 'statuses', 'students'));
    }

    public function storeAttendance(Request $request, AttendanceMeeting $meeting)
    {
        $attendances = $request->attendances;
        if (count($attendances) > 0) {
            $attendanceData = [];
            $n = 0;

            foreach ($attendances as $student_id => $status) {
                $attendanceData[$n]['meeting_id'] = $meeting->id;
                $attendanceData[$n]['student_id'] = $student_id;
                $attendanceData[$n]['attendance_status'] = $status;

                $n++;
            }

            AttendanceData::insert($attendanceData);

            return redirect()
                ->route('attendances.report', $meeting->attendance->id)
                ->withSuccess('Berhasil menyimpan data absensi');
        }
    }

    public function report(Attendance $attendance)
    {
        $attendance_id = $attendance->id;
        $students = Student::all();
        $statuses = [
            1 => 'success',
            'info', 'danger', 'warning'
        ];

        $getReports = AttendanceData::whereHas('meeting', function ($meeting) use ($attendance_id) {
            return $meeting->where('attendance_id', $attendance_id);
        })->get();

        $reports = [];
        foreach ($getReports as $report) {
            $reports[$report->meeting_id][$report->student_id] = $report->attendance_status;
        }

        return view('attendances.report', compact('attendance', 'reports', 'statuses', 'students'));
    }
}
