<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(20);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
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
            'name' => 'required',
            'npm' => 'required|min:9|max:16'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->npm = $request->npm;
        $student->save();

        return redirect()
            ->back()
            ->withSuccess('Berhasil menambahkan mahasiswa baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'npm' => 'required|min:9|max:16'
        ]);

        $student->name = $request->name;
        $student->npm = $request->npm;
        $student->save();

        return redirect()
            ->back()
            ->withSuccess('Berhasil memperbarui data mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->withSuccess('Berhasil menghapus mahasiswa');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:5096|mimes:xls,xlsx,csv'
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileName = time() .'_'. $fileName;

        $file->move('uploads/import-temp', $fileName);
        $fileAddress = 'uploads/import-temp/'. $fileName;

        Excel::import(new StudentImport, $fileAddress);
        File::delete($fileAddress);

        return redirect()
            ->back()
            ->withSuccess('Berhasil mengimpor data mahasiswa');
    }
}
