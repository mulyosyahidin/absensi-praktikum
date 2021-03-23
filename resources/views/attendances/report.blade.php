@extends('layouts.master')
@section('title', $attendance->name)

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
                            <h4 class="card-title">{{ $attendance->name }}</h4>
                            <p>{{ $attendance->course->name }}</p>
                        </div>
                        <div class="card-body">
                            @if (count($students) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="row" rowspan="2">#</th>
                                                <th scope="row" rowspan="2">Nama / NPM</th>
                                                <th colspan="{{ count($attendance->meetings) }}" class="text-center">Absensi Pertemuan</th>
                                            </tr>
                                            <tr>
                                                @foreach ($attendance->meetings as $meeting)
                                                    <td class="text-center">{{ $meeting->meeting_number }}</td>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <th scope="col" rowspan="2">{{ $loop->index + 1 }}</th>
                                                    <td rowspan="2">
                                                        {{ $student->name }}
                                                        <br>
                                                        <b>{{ $student->npm }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                @foreach ($attendance->meetings as $meeting)
                                                    <td colspan="1" class="bg-{{ $statuses[$reports[$meeting->id][$student->id]] }} text-white">
                                                        &nbsp;
                                                    </td>
                                                @endforeach
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
