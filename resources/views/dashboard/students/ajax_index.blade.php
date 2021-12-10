@if (count($students)<1) <div class="col-12 mt-4 text-center">
    <div class="alert alert-danger w-100 p-5">
        <h5> Data tidak ditemukan.</h5>
    </div>
    </div>

    @else
    <div class="col-12 mb-3">
        <p class="d-inline">Tampilkan <i class="bi bi-chevron-right"></i></p>
        <form class="d-inline-flex p-0">
            <select id="pagination_limit" type="text" class="form-select form-select-sm"
                onchange="limitOfPaginate(event)" id="filter_students">
                <option @if ($students->count()==5) selected @endif value="5">5</option>
                <option @if ($students->count()==10) selected @endif value="10">10</option>
                <option @if ($students->count()==15) selected @endif value="15">15</option>
                <option @if ($students->count()==20) selected @endif value="20">20</option>
                <option @if ($students->count()==50) selected @endif value="50">50</option>
                <option @if ($students->count()>50) selected @endif value="100">100</option>
            </select>
        </form>
        <p class="d-inline"> entri .</i></i></p>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">

            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jenis kelamin</th>
                    <th scope="col" style="width:20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key => $student)
                <tr class="align-middle">
                    <th scope="row">{{ $loop->iteration+$students->firstItem()-1 }}</th>
                    <td class="text-center bg-light">
                        <img class="img-fluid" src="{{ asset($student->image) }}" alt=""
                            style="max-width:110px; max-height:110px;height:100px;width:100px">
                    </td>
                    <td><a href="/dashboard/students/{{ $student->nisn }}">
                            <h6 class="p-0">{{ $student->name}}</h6>
                        </a></td>
                    <td>{{ $student->class->name }} ( {{ $student->class->roman }} )</td>
                    <td>{{ $student->gender }}</td>
                    <td>
                        <a href="/dashboard/students/{{ $student->nisn }}/edit" class="btn btn-sm btn-success"><small>
                                <i class="bi bi-pencil-square"></i> Ubah
                            </small>
                        </a>
                        <form class="d-inline">
                            <button class="btn btn-sm btn-danger"
                                onclick="onDeleteButton(event, {{ $student->nisn }}, '{{ csrf_token() }}','/dashboard/students/')"><small><i
                                        class="bi bi-trash"></i>Hapus</small></button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>


        {{-- Custom pagination students --}}
        <div class="row mb-5">
            <div class="col-6 ">
                <p class="p-0 m-0 ">Menampilkan {{ $students->firstItem() }} - {{ $students->lastItem() }}
                    dari
                    {{ $students->total()}} entri</p>
            </div>
            <div class="col-sm-6 d-flex justify-content-end ">
                <nav aria-label="Student page navigation align-items-center">
                    <ul class="pagination" onclick="paginationOnClick(event)">
                        <li class="page-item @if($students->onFirstPage())disabled @endif">
                            <a class="page-link " href="{{ $students->previousPageUrl()}}" aria-label="Previous">
                                &lsaquo;
                            </a>
                        </li>
                        {{-- To cosutm a side of esach current active to 2 items --}}
                        @if ($students->currentPage()-3 > 0)
                        <li class="page-item @if($students->onFirstPage())disabled @endif">
                            <a class="page-link" aria-label="Three dots">
                                <span aria-hidden="true">...</span>
                            </a>
                        </li>
                        @endif
                        @for ($i=0; $i < $students->lastPage(); $i++)
                            <li
                                class="page-item @if($students->currentPage()==$i+1) active @elseif($i+1<=$students->currentPage()-3 || $i+1 >=$students->currentPage()+3)d-none @endif">
                                <a class="page-link" @if($students->currentPage()!=$i+1) href="{{ $students->url($i+1)
                                    }}"
                                    @endif>
                                    {{ $i+1}}
                                </a>
                            </li>
                            @endfor
                            @if ($students->lastPage()-$students->currentPage()>2) <li
                                class="page-item @if($students->onFirstPage())disabled @endif">
                                <a class="page-link" aria-label="Three dots">
                                    <span aria-hidden="true">...</span>
                                </a>
                            </li>
                            @endif
                            <li class="page-item @if(!$students->hasMorePages())disabled @endif">
                                <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-label="Next">
                                    &rsaquo;
                                </a>
                            </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @endif