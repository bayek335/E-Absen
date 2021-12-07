@extends('dashboard.layouts.main')

@section('content')
<div class="col-12 mb-3">
    <form action="" class="d-flex ">
        <div class="form-group">
            <label for="search_name" class="">Filter berdasarkan nama</label>
            <input type="text" name="search" id="search_name" class="form-control form-control-sm m-0 ">
        </div>
        <div class="form-group mx-4">
            <label for="search_class">Filter berdasarkan kelas</label>
            <select type="text" name="search" id="search_class" class="form-select form-select-sm m-0 "
                onchange="filterByClass(event)">
                <option value="">Pilih</option>
                @foreach ($classes as $class)
                <option class="" value="{{ $class->id }}">{{ $class->class }} ( {{ ucFirst($class->name) }}
                    )
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="search_gender">Filter berdasarkan jenis kelamin</label>
            <select name="search" id="search_gender" class="form-select form-select-sm"
                onchange="filterByGender(event)">
                <option value="">pilih</option>
                <option value="perempuan">Perempuan</option>
                <option value="laki-laki">Laki - Laki</option>
            </select>
        </div>
    </form>
</div>
<div class="row" id="class_ajax">
    @include('dashboard.students.ajax_index')
</div>



@endsection