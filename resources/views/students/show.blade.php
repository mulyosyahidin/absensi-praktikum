@extends('layouts.master')
@section('title', 'Mahasiswa')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Mahasiswa</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td><b>{{ $student->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>NPM</td>
                                        <td><b>{{ $student->npm }}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-left">
                                <a href="{{ route('students.edit', $student->id) }}"
                                    rel="tooltip" title="Edit Data {{ $student->name }}">
                                    <span class="btn btn-warning btn-sm">
                                        <span class="material-icons">
                                            mode_edit
                                        </span>
                                    </span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#delete-modal"
                                    rel="tooltip" title="Hapus {{ $student->name }}">
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
            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Mahasiswa?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus Mahasiswa?
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
