@extends('layouts.master')
@section('title', 'Mahasiswa')

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
                            <a href="{{ route('students.create') }}" data-toggle="tooltip" title="Tambah Data Mahasiswa">
                                <span class="float-right btn btn-info btn-sm"
                                    rel="tooltip" title="Tambah Mahasiswa">
                                    <span class="material-icons">add</span>
                                </span>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#import-modal">
                                <span class="float-right btn btn-sm btn-success"
                                    rel="tooltip" title="Impor Data Mahasiswa">
                                    <span class="material-icons">download</span>
                                </span>
                            </a>

                            <h4 class="card-title">Mahasiswa</h4>
                            <p class="card-category">Kelola Mahasiswa</p>
                        </div>
                        @if (count($students) > 0)
                            <div class="card-body">
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
                                                NPM
                                            </th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->id }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->npm }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('students.edit', $student->id) }}"
                                                            rel="tooltip" title="Edit Data {{ $student->name }}">
                                                            <span class="btn btn-warning btn-sm">
                                                                <span class="material-icons">
                                                                    mode_edit
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('students.show', $student->id) }}"
                                                            rel="tooltip" title="Lihat Data {{ $student->name }}">
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
                            </div>

                            <div class="card-footer">
                                <div class="text-center">
                                    {{ $students->links() }}
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="alert alert-info">
                                    Tidak ada data Mahasiswa untuk ditampilkan.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_html')
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Impor Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Pilih sebuah file Excel untuk mengimpor</p>

                        <div class="form-group">
                            <div class="text-center">
                                <label class="bmd-label-floating" for="file">
                                    <span class="btn btn-primary">Pilih File</span>
                                </label>
                            </div>

                            <div class="upload-file-name text-center font-weight-bold"></div>
                            @error('file')
                                <div class="alert alert-danger upload-alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="file" name="file" id="file" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Impor</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        let fileField = document.getElementById('file');
        fileField.addEventListener('change', function() {
            let fullPath = fileField.value;
            if (fullPath) {
                let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf(
                    '/'));
                let fileName = fullPath.substring(startIndex);
                if (fileName.indexOf('\\') === 0 || fileName.indexOf('/') === 0) {
                    fileName = fileName.substring(1);
                }

                let uploadFileName = document.querySelector('.upload-file-name');
                let uploadAlert = document.querySelector('.upload-alert');

                uploadFileName.innerHTML = fileName;
                uploadAlert.innerHTML = '';
                uploadAlert.classList.remove('alert');
                uploadAlert.classList.remove('alert-danger');
            }
        });

        @error('file')
            $('#import-modal').modal('show');
        @enderror

    </script>
@endpush
