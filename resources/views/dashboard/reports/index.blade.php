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
                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i>
                    Ekspor</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col overflow-auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" rowspan="2">No</th>
                    <th scope="col" rowspan="2">NISN</th>
                    <th scope="col" rowspan="2">Nama</th>
                    <th scope="col" rowspan="2">L/P</th>
                    <th scope="col" rowspan="2">Kelas</th>
                    <th scope="col" colspan="31">Bulan</th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 31; $i++) <th>{{ $i }}</th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection