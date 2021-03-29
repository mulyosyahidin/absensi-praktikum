@extends('layouts.master')
@section('title', 'Absensi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Absensi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Nama Absensi</td>
                                        <td><b>{{ $attendance->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Kuliah</td>
                                        <td><b>{{ $attendance->course->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td><b>{{ $attendance->desription }}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-left">
                                <a href="{{ route('attendances.report', $attendance->id) }}"
                                    rel="tooltip" title="Lihat laporan absensi">
                                    <span class="btn btn-info btn-sm">
                                        <span class="material-icons">
                                            book
                                        </span>
                                    </span>
                                </a>
                                <a href="{{ route('courses.edit', $attendance->id) }}"
                                    rel="tooltip" title="Edit Absensi">
                                    <span class="btn btn-warning btn-sm">
                                        <span class="material-icons">
                                            mode_edit
                                        </span>
                                    </span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#delete-modal"
                                    rel="tooltip" title="Hapus Absensi">
                                    <span class="btn btn-danger btn-sm">
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_html')
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Absensi?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus Absensi?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
