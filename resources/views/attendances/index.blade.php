@extends('layouts.master')
@section('title', 'Absensi')

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
                            <a href="{{ route('attendances.create') }}" data-toggle="tooltip" title="Tambah Data Absensi">
                                <span class="float-right btn btn-info btn-sm"
                                    rel="tooltip" title="Buat Absensi Baru">
                                    <span class="material-icons">add</span>
                                </span>
                            </a>
                            <h4 class="card-title">Absensi</h4>
                        </div>
                        <div class="card-body">
                            @if (count($attendances) > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Absensi
                                            </th>
                                            <th>
                                                Mata Kuliah
                                            </th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendances as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->id }}</td>
                                                    <td>{{ $attendance->name }}</td>
                                                    <td>{{ $attendance->course->name }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('attendances.meeting.new', $attendance->id) }}"
                                                            rel="tooltip" title="Buat Pertemuan Baru">
                                                            <span class="btn btn-primary btn-sm">
                                                                <span class="material-icons">
                                                                    book
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('attendances.edit', $attendance->id) }}">
                                                            <span class="btn btn-warning btn-sm"
                                                                rel="tooltip" title="Edit Absensi">
                                                                <span class="material-icons">
                                                                    mode_edit
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('attendances.show', $attendance->id) }}">
                                                            <span class="btn btn-info btn-sm"
                                                                rel="tooltip" title="Lihat Absensi">
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
                                    Tidak ada data Absensi untuk ditampilkan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection