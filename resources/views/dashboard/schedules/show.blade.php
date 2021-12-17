@extends('dashboard.layouts.main')

@section('content')
@if (session()->has('success'))
<div class="row">
    <div class="col-lg-810 alert alert-success text-center">
        {{ session('success') }} <i class="bi bi-check-lg"></i>
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-10">
        <h5>Jadwal pelajaran</h5>
        <ul class="list-group shadow-sm border">
            <li class="list-group-item active" aria-current="true">{{ ucFirst($schedules[0]->day_name)
                }}</li>
            <table class="table table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Jam ke-</th>
                        <th>Mapel</th>
                        <th>Dimulai</th>
                        <th colspan="2">Berakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $sc)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $sc->o_clock }}</td>
                        <th>{{ ucFirst($sc->sbj_name) }}</th>
                        <td>{{ $sc->start }}</td>
                        <td>{{ $sc->end }}</td>
                        <td>
                            <form class="d-inline float-end px-2">
                                <button class="btn btn-danger rounded-circle px-1 py-0"><i class="bi bi-x-circle"
                                        onclick="onDeleteButton(event, {{ $sc->schedule_id }}, '{{ csrf_token() }}', '/dashboard/schedules/')"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-2 mb-3">
                <button class="btn btn-sm btn-success">
                    <small><i class="bi bi-pencil-square"></i>Perbarui</small>
                </button>
                <form class="d-inline" method="POST"
                    action="/dashboard/days/{{ $schedules[0]->day_id }}/classes/{{ $schedules[0]->class_id }}"
                    onclick="!confirm('Anda yakin ingin menghapus seluruh data ini')?event.preventDefault():''">
                    @method("DELETE")
                    @csrf
                    <button class="btn btn-sm btn-danger">
                        <small><i class="bi bi-trash"></i> Hapus semua</small>
                    </button>
                </form>
            </div>
        </ul>
    </div>
</div>
@endsection