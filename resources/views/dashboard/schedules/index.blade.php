@extends('dashboard.layouts.main')

@section('content')
<a href="/dashboard/schedules/create" class="btn btn-primary">tambah</a>
@if (session()->has('success'))
<div class="row justify-content-center">
    <div class="col-8">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="width: 5%">No</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Mapel</th>
                    <th scope="col" style="width: 25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $sc)
                <tr>
                    <th scope="row">{{ $loop->iteration }} </th>
                    <td>{{ $sc->day_name}}</td>
                    <td>{{ $sc->class_name}} ( {{ $sc->roman }} )</td>
                    <td>{{ $sc->sbj_count }}</td>
                    <td>
                        <a href="/dashboard/days/{{ $sc->day_id }}/classes/{{ $sc->class_id }}"
                            class="btn btn-sm btn-info"><small>Detail</small></a>
                        <a href="/dashboard/schedules/1" class="btn btn-sm btn-success"><small>Ubah</small></a>
                        <form class="d-inline" action="/dashboard/schedules/hari" method="POST">
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-sm btn-danger"><small>Hapus</small></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection