@extends('layouts.master')
@section('title', 'Pertemuan Absensi')

@section('custom_head')
    <link rel="stylesheet" href="{{ asset('assets/plugins/air-datepicker/dist/css/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Pertemuan Absensi</h4>
                            <p>Buat pertemuan baru untuk absensi <b>{{ $attendance->name }}</b></p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attendances.meeting.new.store', $attendance->id) }}" method="POST">
                                @csrf

                                <div class="row mt-3">
                                    @if (session()->has('success'))
                                        <div class="col-12">
                                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Pertemuan ke</label>
                                            <input type="number" class="form-control @error('meeting_number') is-invalid @enderror"
                                                name="meeting_number" value="{{ old('meeting_number') }}" required>

                                            @error('meeting_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Tanggal</label>
                                            <input type="text" class="form-control @error('date') is-invalid @enderror"
                                                name="date" id="date" value="{{ old('date') }}" required>

                                            @error('date')
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

                                <button type="submit" class="btn btn-primary pull-right">Buat</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script src="{{ asset('assets/plugins/air-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/air-datepicker/dist/js/i18n/datepicker.id.js') }}"></script>

    <script>
        $('#date').datepicker({
            language: 'id',
            todayButton: new Date(),
            autoClose: true
        });
    </script>
@endpush