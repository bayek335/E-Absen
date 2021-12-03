@extends('dashboard.layouts.main')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <form class="form-create-teacher" action="/dashboard/teachers/{{ $teacher->id }}" method="POST">
            @method("PUT")
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror " id="name"
                    aria-describedby="name" autocomplete="off" autofocus name="name"
                    value="@if(old('name')){{ old('name') }}@else{{ $teacher->name }}@endif">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-select-sm @error('status') is-invalid @enderror" id="status"
                    aria-describedby="status" onchange="statusOnChange(event)" name="status">
                    <option value="">Pilih...</option>
                    @foreach ($status as $st)
                    <option @if ($st->id == $teacher->status_id){{ 'selected' }} @endif value="{{ $st->id
                        }}">@if($st->homeroom>0){{ 'Wali
                        kelas' }}@else{{ $st->name }}@endif
                    </option>
                    @endforeach
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 d-none">
                <label for="class" class="form-label">Kelas</label>
                <select class="form-select form-select-sm @error('class') is-invalid @enderror" id="class"
                    aria-describedby="class" name="class"
                    value="@if(old('class')){{ old('class') }}@elseif($teacher->status->homeroom>0){{ $teacher->class->id }}@endif">
                    @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }} ( {{ $class->roman }} )</option>
                    @endforeach
                </select>
                @error('class')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Mata Pelajaran <small onclick="onDeleteSubject()" role="button"
                        class="badge bg-warning text-dark">kosongkan</small></label>
                <select type="email" class="form-select form-select-sm @error('subjets') is-invalid @enderror"
                    id="subject" aria-describedby="subject" onchange="subjectOnChange(event)">
                    <option value="">Pilih...</option>
                    @foreach ($subjects as $subject)
                    <option value="{{ $subject->name }}">{{ $subject->name }}
                    </option>
                    @endforeach
                </select>
                @error('subjects')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                @php
                $subjects = [];
                foreach ($teacher->subjects as $subject) {
                array_push($subjects, $subject->name);
                }
                @endphp
                <input id="subjects" class="form-control form-control-smborder-0 mt-2" type="text" readonly
                    name="subjects" value="{{ implode(',',$subjects) }}">

            </div>
            <button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
        </form>
    </div>
</div>

<script>
    if(document.querySelector("select#status").value==2){
        document.querySelector(".form-create-teacher .d-none").classList.replace('d-none', 'd-block')
    }
    statusOnChange = (e)=>{
        if(e.target.value == 2){
            document.querySelector(".form-create-teacher .d-none").classList.replace('d-none', 'd-block')
        }else if(document.querySelector(".form-create-teacher .d-block")){
            document.querySelector(".form-create-teacher .d-block").classList.replace('d-block', 'd-none')
        }
    }

    let subject_area = document.querySelector("#subjects");
    const subjects = [];
    subjectOnChange=(e)=>{
        if (!subjects.includes(e.target.value)) {
        subjects.push(e.target.value)
        }
        subject_area.value = subjects
    }
    onDeleteSubject=()=>{
        subjects.splice(0);
        subject_area.value = subjects

    }

</script>

@endsection