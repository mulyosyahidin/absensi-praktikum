@extends('layouts.master')
@section('title', 'Edit Absensi')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Absensi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
                                @csrf
                                @method('PUT')

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
                                                <option disabled="disabled">Pilih Mata Kuliah</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        @if ($attendance->course_id == $course->id) selected="selected" @endif>{{ $course->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('course_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Absensi</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $attendance->name) }}" required>

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
                                                name="description">{{ old('description', $attendance->description) }}</textarea>

                                            @error('description')
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
