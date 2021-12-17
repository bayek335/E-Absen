@extends('dashboard.layouts.main')

@section('content')
@if (session()->has('fail'))
<div class="row justify-content-center">
    <div class="col">
        <div class="alert alert-danger text-center">
            {!! session('fail')!!}
        </div>
    </div>
</div>
@endif
<div class="row">
    <h5>Form pembaruan jadwal pelajaran

    </h5>
    <div class="col-12">
        <form action="/dashboard/days/{{ $schedule[0]->day_id }}/classes/{{ $schedule[0]->class_id }}/edit"
            method="post">
            @method('PUT')
            @csrf
            <div id="create_schedule_form">
                @foreach ($schedule as$key => $sc)
                <div class="row bg-light rounded p-2 pb-3 border mb-3" id="create_schedule_row">
                    <input type="hidden" name="schedule_id[]" value="{{ $sc->schedule_id }}">
                    <div class="col">
                        <label for="day">Hari</label>
                        <select class="form-select form-select-sm" name="day[]" id="day">
                            <option value="">Pilih</option>
                            @foreach ($days as $day)
                            <option @if ($sc->day_id==$day->id)
                                selected @else disabled
                                @endif value="{{ $day->id }}">{{ ucFirst($day->name) }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('day.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('day.'.$key)[0] }}
                        </small>
                        @endif
                    </div>
                    <div class="col-lg-1 col-md-2 col-2">
                        <label for="clock">Jam ke-</label>
                        <input type="number" max="10" min="1" class="form-control form-control-sm" name="clock[]"
                            value="{{ $sc->o_clock }}" readonly>
                        @if($errors->has('clock.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('clock.'.$key)[0] }}
                        </small>
                        @endif
                    </div>
                    <div class="col">
                        <label for="subject">Mapel</label>
                        <select name="subjects[]" id="subject" class="form-select form-select-sm">
                            <option value="">Pilih</option>
                            @foreach ($subjects as $subject)
                            <option @if ($sc->sbj_id==$subject->id)
                                selected
                                @endif value="{{ $subject->id }}">{{ ucFirst($subject->name) }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('subjects.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('subjects.'.$key)[0] }}
                        </small>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-primary px-4">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection