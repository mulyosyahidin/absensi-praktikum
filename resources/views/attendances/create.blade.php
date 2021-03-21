@extends('layouts.master')
@section('title', 'Buat Absensi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Buat Absensi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attendances.store') }}" method="POST">
                                @csrf

                                <div class="row mt-3">
                                    @if (session()->has('success'))
                                        <div class="col-12">
                                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="courses" class="md-label-floating">Mata Kuliah</label>
                                            <select name="course_id" id="courses" class="form-control @error('course_id') is-invalid @enderror" required="required">
                                                <option disabled="disabled" selected="selected">Pilih Mata Kuliah</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('course_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            @if (count($courses) == 0)
                                                <div class="text-danger">
                                                    Anda harus menambah mata kuliah untuk membuat absensi. <a href="{{ route('courses.create') }}" target="_blank">Tambah mata kuliah.</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Absensi</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required>

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Deskripsi</label>
                                            <textarea
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description">{{ old('description') }}</textarea>

                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" @if (count($courses) == 0) disabled @endif>Buat</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
