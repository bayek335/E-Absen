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
    </div>
</div>

<div class="row">
    @if (session()->has('fail'))
    <div class="col-12 mb-3">
        <div class="alert alert-danger text-center">{!! session('fail')!!}</div>
    </div>
    @endif
    <div class="col-md-4 bg-light rounded shadow text-center mb-3 pb-3">
        <div class=" w-100 pt-4">
            <h4>Tanggal</h4>
            <h5 class="mb-4">{{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
            <hr>
            <h4>Jam Masuk</h4>
            <h5 class="mb-4">07.00</h5>
            <hr>
            <h4>Jam</h4>
            <h3 class="this-time fw-bold"></h3>
        </div>
    </div>
    <div class="col-md-8">
        <form action="/dashboard/absents" method="post">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr class="align-middle">
                        <th scope="col" rowspan="2">No</th>
                        <th scope="col" rowspan="2">Nama</th>
                        <th scope="col" rowspan="2">Kelas</th>
                        <th scope="col" colspan="3" class="text-center">Keterangan</th>
                    </tr>
                    <tr>
                        <th class="p-0 text-center text-white bg-success" role="button">
                            <div class="" onclick="absentCheckAll(1)">
                                <small>semua</small><i class="bi bi-check2-all"></i>
                            </div>
                        </th>
                        <th class="p-0 text-center text-white bg-warning" role="button">
                            <div class="" onclick="absentCheckAll(2)">
                                <small>semua</small><i class="bi bi-check2-all"></i>
                            </div>
                        </th>
                        <th class="p-0 text-center text-white bg-danger" role="button">
                            <div class="" onclick="absentCheckAll(3)">
                                <small>semua</small><i class="bi bi-check2-all"></i>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $student->name }}</td>
                        <td>Enam ( VI )</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input attend" type="radio" name="desc[{{ $student->id }}]"
                                    id="hadir{{ $student->id }}" value="1">
                                <label class="form-check-label" for="hadir{{ $student->id }}">
                                    Hadir
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input permit" type="radio" name="desc[{{ $student->id }}]"
                                    id="izin{{ $student->id }}" value="2">
                                <label class="form-check-label" for="izin{{ $student->id }}">
                                    Izin
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input alpha" type="radio" name="desc[{{ $student->id }}]"
                                    id="alpha{{ $student->id }}" value="3">
                                <label class="form-check-label" for="alpha{{ $student->id }}">
                                    Alfa
                                </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <button class="btn btn-sm btn-primary px-4 ">Kirim</button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>

@endsection