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
    <h5>Form tambah jadwal pelajaran
        <small onchange="addRowSchedules()"><input class="d-inline w-25 form-control form-control-sm" type="number"
                id="num_create_schedule_row" min="1" max="10"></small>
    </h5>
    <div class="col-12">
        <form action="/dashboard/schedules" method="post">
            @csrf
            <div id="create_schedule_form">
                <div class="row bg-light rounded p-2 pb-3 border mb-3" id="create_schedule_row">
                    <div class="col">
                        <label for="day">Hari</label>
                        <select class="form-select form-select-sm" name="day[]" id="day" required>
                            <option value="">Pilih</option>
                            @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ ucFirst($day->name) }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('day.*'))
                        @foreach ($errors->get('day.*') as $key => $item)
                        @if($errors->has('day.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('day.'.$key)[0] }}
                        </small>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="col-lg-1 col-md-2 col-2">
                        <label for="clock">Jam ke-</label>
                        <input type="number" max="10" min="1" class="form-control form-control-sm" name="clock[]"
                            required>
                        @if ($errors->has('clock'))
                        @foreach ($errors->get('clock') as $key => $item)
                        @if($errors->has('clock.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('clock.'.$key)[0] }}
                        </small>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="col">
                        <label for="subject">Mapel</label>
                        <select name="subject[]" id="subject" class="form-select form-select-sm" required>
                            <option value="">Pilih</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ ucFirst($subject->name) }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('day'))
                        @foreach ($errors->get('day') as $key => $item)
                        @if($errors->has('subject.'.$key))
                        <small class="text-danger">
                            {{ $errors->get('subject.'.$key)[0] }}
                        </small>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-primary px-4">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection