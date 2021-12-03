@extends('dashboard.layouts.main')

@section('content')
<div class="row mb-3 border-bottom">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 border mb-1 rounded">
        <div class="nav-toolbar">
            <nav class=""
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active"><a class="">Home</a></li>
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0 ">
            <div class="btn-group me-1">
                <button type="button" class="btn btn-sm btn-outline-primary"
                    onclick="location.href='/dashboard/teachers/create'"><i class="bi bi-person-plus"></i>
                    Tambah</button>
            </div>
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i>
                    Ekspor</button>
            </div>
        </div>
    </div>
</div>
@if(session()->has('success'))
<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <div class="alert alert-success">{!! session('success') !!}</div>
    </div>
</div>
@endif
<div class="row teacher">

    @foreach ($teachers as $teacher)
    <div class="col-lg-3 col-md-4 col-sm-4 mt-2">
        <div class="card shadow">
            <div id="delete-btn" onclick="deleteOnClick(event)"><i data-id="{{ $teacher->id }}"
                    data-token="{{ csrf_token() }}" class="bi bi-x"></i>
            </div>
            <p id="delete-message">Hapus data ini?</p>
            <img src="{{ asset('/assets/images/bayu.jpg') }}" class=" bg-light" alt="">
            <div class="card-body text-center pt-2">
                <h5 class="card-title m-0 p-0">{{ $teacher->name }}</h5>
                <p class="m-0 p-0 text-uppercase">{{ $teacher->status->name }}</p>
                @if ($teacher->status->homeroom >0)
                <p>Wali kelas : {{ $teacher->class->name.' ( '. $teacher->class->roman.' )'}}</p>
                @else
                <p class="mb-sm-4 pt-sm-3"></p>
                @endif
                <div class="text-start bg-light p-sm-2 border">
                    <a href="/dashboard/teachers/{{ $teacher->id }}" class="btn btn-sm px-3 btn-primary">Detail</a>
                    <a href="/dashboard/teachers/{{ $teacher->id }}/edit" class="btn btn-sm px-3 btn-success">Ubah</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <style>
        .teacher #delete-btn {
            position: absolute;
            font-size: 20px;
            color: white;
            padding: 0 5px;
            border-radius: 50%;
            border: none;
            top: -10px;
            right: -10px;
            background-color: red;
            cursor: pointer;
        }

        .teacher .card {
            transition: 300ms ease all;
        }

        #delete-message {
            position: absolute;
            font-size: 12px;
            color: white;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 25px;
            border-bottom-left-radius: 0;
            border: none;
            background-color: red;
            right: -9em;
            top: -2.5em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: 300ms ease all;
        }

        .teacher #delete-btn:hover~#delete-message {
            opacity: 1;
        }

        #delete-btn:hover {
            background-color: red;
        }

        .teacher .card:hover {
            transform: scale(1.02)
        }



        .teacher .card::before:hover~.card::after {
            content: "Hapus data ini?";
            position: absolute;
            color: red;
        }

        @media screen and (max-width:577px) {

            #delete-btn,
            #delete-message {
                display: none;
            }
        }
    </style>
</div>
@endsection