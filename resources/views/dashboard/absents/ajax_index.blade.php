@if (count($absents) <1) <div class="alert alert-danger text-center">
    Data belum tersedia
    </div>
    @else
    <a href="/dashboard/absents/class/{{ $absents[0]->class_id }}/date/{{ $absents[0]->created_at }}/edit"
        class="btn btn-sm btn-success mb-3">Perbarui
        semua</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Hadir</th>
                <th scope="col">Pulang</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absents as $abs)
            <tr>
                <th scope="row">{{ $loop->iteration+$absents->firstItem()-1 }}</th>
                <td>{{ $abs->name }}</td>
                <td>Enam ( VI )</td>
                <td>{{ $abs->year }}-{{ $abs->month }}-{{ $abs->day }}</td>
                <td>{{ $abs->enter }}</td>
                <td>{{ $abs->out }}</td>
                <td>
                    @if ($abs->attend)
                    Hadir
                    @elseif($abs->permit)
                    Izin
                    @elseif($abs->alpha)
                    Alfa
                    @endif
                </td>
                <td>

                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                        data-bs-target="#absent_modal_{{ $abs->absent_id }}">
                        <small>Ubah</small>
                    </button>
                    <a href="/dashboard/absents/{{ $abs->absent_id }}">

                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row mb-5">
        <div class="col-6 ">
            <p class="p-0 m-0 ">Menampilkan {{ $absents->firstItem() }} - {{ $absents->lastItem() }}
                dari
                {{ $absents->total()}} entri</p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end ">
            <nav aria-label="Student page navigation align-items-center">
                <ul class="pagination" onclick="absentPaginationOnClick(event)">
                    <li class="page-item @if($absents->onFirstPage())disabled @endif">
                        <a class="page-link " href="{{ $absents->previousPageUrl()}}" aria-label="Previous">
                            &lsaquo;
                        </a>
                    </li>
                    {{-- To cosutm a side of esach current active to 2 items --}}
                    @if ($absents->currentPage()-3 > 0)
                    <li class="page-item @if($absents->onFirstPage())disabled @endif">
                        <a class="page-link" aria-label="Three dots">
                            <span aria-hidden="true">...</span>
                        </a>
                    </li>
                    @endif
                    @for ($i=0; $i < $absents->lastPage(); $i++)
                        <li
                            class="page-item @if($absents->currentPage()==$i+1) active @elseif($i+1<=$absents->currentPage()-3 || $i+1 >=$absents->currentPage()+3)d-none @endif">
                            <a class="page-link" @if($absents->currentPage()!=$i+1) href="{{ $absents->url($i+1)
                                }}"
                                @endif>
                                {{ $i+1}}
                            </a>
                        </li>
                        @endfor
                        @if ($absents->lastPage()-$absents->currentPage()>2) <li
                            class="page-item @if($absents->onFirstPage())disabled @endif">
                            <a class="page-link" aria-label="Three dots">
                                <span aria-hidden="true">...</span>
                            </a>
                        </li>
                        @endif
                        <li class="page-item @if(!$absents->hasMorePages())disabled @endif">
                            <a class="page-link" href="{{ $absents->nextPageUrl() }}" aria-label="Next">
                                &rsaquo;
                            </a>
                        </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <!-- Modal -->
        @foreach ($absents as $abs)
        <div class="modal fade" id="absent_modal_{{ $abs->absent_id }}" tabindex="-1"
            aria-labelledby="absent_modal_label" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/dashboard/absents/{{ $abs->absent_id }}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="absent_modal_label">{{ $abs->name }} ( {{ $abs->nisn }} )</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="alert alert-warning py-0"><small>Click tombol pulang untuk mngatur jam pulang
                                    siswa
                                    (Jika ada).</small></p>
                            <p>Tanggal : {{ Carbon\Carbon::parse($abs->day)->format('D') }}, {{
                                Carbon\Carbon::parse($abs->day)->format('d') }} {{
                                Carbon\Carbon::parse($abs->month)->format('F') }} {{
                                Carbon\Carbon::parse($abs->year)->format('Y') }}
                            </p>
                            <div class="row">
                                <div class="col-md form-group">
                                    <label for="enter">Hadir</label>
                                    <input id="enter" type="time" class="form-control form-control-sm"
                                        value="{{ $abs->enter }}" disabled required>
                                </div>
                                <div class="col-md form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="out">Hadir</label>
                                            <input id="out_{{ $abs->absent_id }}" type="time" step="any"
                                                class="form-control form-control-sm"
                                                value="@if($abs->out){{ $abs->out }}@endif" @if($abs->out)
                                            readonly @else required @endif name="out">
                                        </div>
                                        @if(!$abs->out)
                                        <div class="col-4 d-flex align-items-end">
                                            <small role="button" onclick="setOutOnClick('out_{{ $abs->absent_id }}')"
                                                class="btn btn-sm btn-success">Pulang</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="desc">Keterangan</label>
                                    <select type="text" id="desc" class="form-select form-select-sm" name="desc">
                                        <option @if ($abs->attend)
                                            selected
                                            @endif value="1">Hadir</option>
                                        <option @if ($abs->permit)
                                            selected
                                            @endif value="2">Izin</option>
                                        <option @if ($abs->alpha)
                                            selected
                                            @endif value="3">Alfa</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="class" value="{{ $abs->class_id   }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan
                                perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif