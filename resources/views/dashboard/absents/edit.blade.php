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
            @if ($absents[0]->enter)
            <h4>Jam Keluar</h4>
            <h5 class="mb-4">12.00</h5>
            @else
            <h4>Jam Masuk</h4>
            <h5 class="mb-4">07.00</h5>
            @endif
            <hr>
            <h4>Jam</h4>
            <h3 class="this-time fw-bold"></h3>
        </div>
    </div>
    <div class="col-md-8">
        <form action="/dashboard/absents/class/{{ $absents[0]->class_id }}/date/{{ $absents[0]->created_at }}/edit"
            method="post">
            @method("PUT")
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr class="align-middle">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">Keterangan</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Pulang</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($absents as$key=> $abs)
                    <input type="hidden" name="absent_id[]" value="{{ $abs->absent_id }}">
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $abs->name }}</td>
                        <td>
                            <select name="desc[]" class="form-select form-select-sm" required>
                                <option @if ($abs->attend)selected @endif value="1">Hadir</option>
                                <option @if ($abs->permit)selected @endif value="2">Izin</option>
                                <option @if ($abs->alpha)selected @endif value="3">Alfa</option>
                            </select>
                            @if($errors->has('desc.'.$key))
                            <small class="text-danger">
                                {{ $errors->get('desc.'.$key)[0] }}
                            </small>
                            @endif
                        </td>
                        <td>{{ $abs->enter }}</td>
                        <td>
                            <input type="time" class="form-control form-control-sm" value="{{ $abs->out }}" name="out[]"
                                id="absent_update_out" step="2">
                            @if($errors->has('out.'.$key))
                            <small class="text-danger">
                                {{ $errors->get('out.'.$key)[0] }}
                            </small>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <button type="submit" class="btn btn-sm btn-primary px-4">Kirim</button>
                            <small class="alert alert-warning py-1">Untuk mengatur jam pulang klik tombol pulang</small>
                        </th>
                        <th class="text-center">
                            <div class="btn btn-sm btn-success px-4" onclick="setOutOnClick('absent_update_out')">
                                <small><i class="bi bi-clock"></i> Pulang</small>
                            </div>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>

@endsection