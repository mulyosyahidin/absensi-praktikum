@extends('layouts.master')
@section('title', 'SI Absensi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">supervisor_account</i>
                            </div>
                            <p class="card-category">Mahasiswa</p>
                            <h3 class="card-title">
                                {{ $overview['student'] }}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{ route('students.index') }}">Kelola Mahasiswa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">library_books</i>
                            </div>
                            <p class="card-category">Mata Kuliah</p>
                            <h3 class="card-title">
                                {{ $overview['course'] }}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{ route('courses.index') }}">Kelola Mata Kuliah</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">bookmarks</i>
                            </div>
                            <p class="card-category">Absensi</p>
                            <h3 class="card-title">
                                {{ $overview['attendance'] }}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{ route('attendances.index') }}">Kelola Pertemuan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">pie_chart</i>
                            </div>
                            <p class="card-category">Pertemuan</p>
                            <h3 class="card-title">
                                {{ $overview['meeting'] }}
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="">Lihat Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Absensi</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    @if (count($attendances) > 0)
                                        <table class="table">
                                            <tbody>
                                                @foreach ($attendances as $attendance)
                                                    <tr>
                                                        <td>
                                                            <a href="">{{ $attendance->name }}</a>
                                                            <br>
                                                            {{ $attendance->course->name }}
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <a
                                                                href="{{ route('attendances.meeting.new', $attendance->id) }}">
                                                                <button type="button" rel="tooltip" title="Pertemuan Baru"
                                                                    class="btn btn-primary btn-link btn-sm">
                                                                    <i class="material-icons">book</i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('attendances.report', $attendance->id) }}">
                                                                <button type="button" rel="tooltip" title="Lihat laporan"
                                                                    class="btn btn-info btn-link btn-sm">
                                                                    <i class="material-icons">pie_chart</i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-info">
                                            Tidak ada data untuk ditampilkan.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
