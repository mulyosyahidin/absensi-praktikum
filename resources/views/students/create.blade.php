@extends('layouts.master')
@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Tambah Mahasiswa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('students.store') }}" method="POST">
                                @csrf

                                <div class="row mt-3">
                                    @if (session()->has('success'))
                                        <div class="col-12">
                                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Mahasiswa</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required>

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">NPM</label>
                                            <input type="text"
                                                class="form-control @error('npm') is-invalid @enderror"
                                                    name="npm" value="{{ old('npm') }}" required>

                                            @error('npm')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
