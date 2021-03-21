@extends('layouts.master')
@section('title', $meeting->attendance->name)

@section('custom_head')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');

        :root {
            --white: #ffffff;
            --light: #f0eff3;
            --black: #000000;
            --dark-blue: #1f2029;
            --dark-light: #353746;
            --red: #da2c4d;
            --yellow: #f8ab37;
            --grey: #ecedf3;
        }

        ::selection {
            color: var(--white);
            background-color: var(--black);
        }

        ::-moz-selection {
            color: var(--white);
            background-color: var(--black);
        }

        mark {
            color: var(--white);
            background-color: var(--black);
        }

        .checkbox:checked~.background-color {
            background-color: var(--white);
        }


        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked),
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            position: absolute;
            left: -9999px;
            width: 0;
            height: 0;
            visibility: hidden;
        }

        .checkbox-tools:checked+label,
        .checkbox-tools:not(:checked)+label {
            position: relative;
            display: inline-block;
            padding: 5px;
            width: 110px;
            font-size: 12px;
            line-height: 20px;
            letter-spacing: 1px;
            margin: 0 auto;
            margin-left: 5px;
            margin-right: 5px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 4px;
            overflow: hidden;
            cursor: pointer;
            text-transform: uppercase;
            color: var(--black);
            -webkit-transition: all 300ms linear;
            transition: all 300ms linear;
        }

        .checkbox-tools:not(:checked)+label {
            background-color: var(--white);
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
        }

        .checkbox-tools:checked+label {
            background-color: transparent;
            color: #fff;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools.success:checked+label {
            background-color: #55B559;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools.info:checked+label {
            background-color: #00CAE3;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools.warning:checked+label {
            background-color: #FF9E0F;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools.danger:checked+label {
            background-color: #F55145;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools:not(:checked)+label:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .checkbox-tools:checked+label::before,
        .checkbox-tools:not(:checked)+label::before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 4px;
            background-image: linear-gradient(298deg, var(--red), var(--yellow));
            z-index: -1;
        }

        .checkbox-tools:checked+label .uil,
        .checkbox-tools:not(:checked)+label .uil {
            font-size: 24px;
            line-height: 24px;
            display: block;
            padding-bottom: 10px;
        }

        .checkbox:checked~.section .container .row .col-12 .checkbox-tools:not(:checked)+label {
            background-color: var(--light);
            color: var(--dark-blue);
            box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Pertemuan {{ $meeting->meeting_number }}</h4>
                            <p>{{ $meeting->attendance->course->name }}</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attendances.meeting.store', $meeting->id) }}" method="post">
                                @csrf

                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NPM</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->npm }}</td>
                                                    <td>
                                                        <div class="attendance-status text-right">
                                                            @foreach ($statuses as $status)
                                                                <input class="checkbox-tools {{ $status->classes }}" type="radio" name="attendances[{{ $student->id }}]"
                                                                    id="status-{{ $student->id }}-{{ $status->id }}" value="{{ $status->id }}">
                                                                <label class="for-checkbox-tools" for="status-{{ $student->id }}-{{ $status->id }}">
                                                                    {{ $status->name }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <input type="submit" value="Simpan" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
