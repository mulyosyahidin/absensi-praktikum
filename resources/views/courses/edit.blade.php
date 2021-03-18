@extends('layouts.master')
@section('title', 'Edit Mata Kuliah')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Mata Kuliah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('courses.update', $course->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mt-3">
                                    @if (session()->has('success'))
                                        <div class="col-12">
                                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Mata Kuliah</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $course->name) }}" required>

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Semester</label>
                                            <input type="number"
                                                class="form-control @error('semester') is-invalid @enderror" msin="1"
                                                masx="8" name="semester" value="{{ old('semester', $course->semester) }}" required>

                                            @error('semester')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
