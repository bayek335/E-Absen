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
            <div class="btn-group me-2">
                <button onclick="absentExport(event)" type="button" class="btn btn-sm btn-outline-secondary"><i
                        class="bi bi-download"></i>
                    Ekspor</button>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-4">
        <label for="month">Bulan</label>
        <select id="reports_month" class="form-select form-select-sm" onchange="reportSelectMonth(event)">
            @foreach ($month as $key => $mn)
            <option @if (date('m')==$key+1) selected @endif value="{{ $key+1 }}">{{ ucFirst($mn) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4">
        <label for="year" class="d-block">Tahun</label>
        <div class="input-group input-group-sm">
            <input class="datepicker form-control" onchange="reportSelectYear(event)" id="year">
            <span class="input-group-text" id="inputGroup-sizing-sm">
                <i class="bi bi-calendar3" for="year"></i>
            </span>
        </div>
    </div>
    <div class="col-sm-4">
        <label for="oneyear" class="d-block">Absensi / Tahun</label>
        <div class="input-group input-group-sm">
            <input class="datepicker form-control" onchange="reportSelectOneYear(event)" id="oneyear">
            <span class="input-group-text" id="inputGroup-sizing-sm">
                <i class="bi bi-calendar3"></i>
            </span>
        </div>
    </div>
</div>
<div id="reports_table">
    @include('dashboard.reports.index_ajax')
</div>
@endsection