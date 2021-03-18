@extends('layouts.master')
@section('title', 'Mata Kuliah')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-info">{{ session()->get('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <a href="{{ route('courses.create') }}" data-toggle="tooltip" title="Tambah Data Mata Kuliah">
                                <span class="float-right btn btn-info btn-sm">
                                    <span class="material-icons">add</span>
                                </span>
                            </a>
                            <h4 class="card-title">Mata Kuliah</h4>
                            <p class="card-category">Kelola mata kuliah</p>
                        </div>
                        <div class="card-body">
                            @if (count($courses) > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Semester
                                            </th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $course->id }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->semester }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('courses.edit', $course->id) }}">
                                                            <span class="btn btn-warning btn-sm">
                                                                <span class="material-icons">
                                                                    mode_edit
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('courses.show', $course->id) }}">
                                                            <span class="btn btn-info btn-sm">
                                                                <span class="material-icons">
                                                                    remove_red_eye
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Tidak ada data mata kuliah untuk ditampilkan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection