@extends('dashboard.layouts.main')

@section('content')
<div class="row mb-3 py-2 border-bottom">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-2 border mb-1 rounded">
        <div class="nav-toolbar">
            <nav class=""
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                @php
                $url = explode('/', url()->current());
                $new_url = array_slice($url, 3);
                @endphp
                <ol class="breadcrumb mb-0">
                    @foreach ($new_url as $key => $item)
                    @if($key!=count($new_url)-1)
                    <li class="breadcrumb-item"><a class="" href="/{{ $item }}">{{ucFirst($item) }}</a></li>
                    @else
                    <li class="breadcrumb-item active"><a class="">{{ucFirst($item) }}</a></li>
                    @endif
                    @endforeach
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0 ">
            <a href="/dashboard/absents/create" class="btn btn-sm btn-primary ">Absensi baru</a>
        </div>
    </div>
</div>
@if (session()->has('success'))
<div class="row">
    <div class="col">
        <div class="alert alert-success text-center">
            {!! session('success')!!}
        </div>
    </div>
</div>
@endif
<div class="row justify-content-end">
    <div class="col-4 mb-2 ">
        <select id="absent_filter_class" class="form-select form-select-sm">
            <option value="">Pilih...</option>
            @foreach ($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }} ( {{ $class->roman }} )</option>
            @endforeach
        </select>
    </div>
    <div id="absent_students">
        @include('dashboard.absents.ajax_index')
    </div>
</div>
@endsection