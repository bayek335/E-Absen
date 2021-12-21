<div class="row">
    @if ($one_year)\
    @endif
    <div class="col overflow-auto">
        <table class="table table-bordered">
            @if ($one_year)
            <thead>
                <tr>
                    <th style="text-align: left; font-weight:bold ;font-size: 24px" colspan="{{ count($month)+8 }}">
                        Laporan Absensi Tahun : {{
                        $request['year'] }}</th>
                </tr>
                <tr>
                    <th scope="col" rowspan="2" style="text-align: left">No</th>
                    <th scope="col" rowspan="2" style="text-align: left">NISN</th>
                    <th scope="col" rowspan="2" style="text-align: left">Nama</th>
                    <th scope="col" rowspan="2" style="text-align: left">L/P</th>
                    <th scope="col" rowspan="2" style="text-align: left">Kelas</th>
                    <th scope="col" colspan="{{ count($month) }}" class="text-center">Bulan</th>
                    <th scope="col" colspan="3" class="text-center">Total</th>
                </tr>
                <tr>
                    @for ($i=0; $i<count($month); $i++) <th>
                        {{ ucFirst($month[$i])}}
                        </th>
                        @endfor
                        <th class="">H</th>
                        <th class="bg-warning">I</th>
                        <th class="bg-danger text-white">A</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($absents as $abs)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $abs->nisn }}</td>
                    <td>{{ $abs->name }}</td>
                    <td>{{ucFirst(substr($abs->gender, 0,1))}}</td>
                    <td></td>
                    @php
                    $attend=0;
                    $permit=0;
                    $alpha=0;
                    @endphp
                    @for ($i = 1; $i < count($month)+1; $i++) <td>
                        @foreach ($countAttendYear as $countAttend)
                        @if ($abs->student_id == $countAttend->student_id)
                        @if ($countAttend->month == $i)
                        {{ $countAttend->attend_total }}
                        @php
                        $attend += $countAttend->attend_total;
                        $permit += $countAttend->permit_total;
                        $alpha += $countAttend->alpha_total;
                        @endphp
                        @endif
                        @endif
                        @endforeach
                        </td>
                        @endfor

                        <td style="font-weight: bold;text-align: center">
                            {{ $attend }}
                        </td>
                        <td style="font-weight: bold;text-align: center">@if ($permit>0)
                            {{ $permit }}
                            @endif</td>
                        <td style="font-weight: bold;text-align: center">@if ($alpha>0)
                            {{ $alpha }}
                            @endif</td>
                </tr>
                @endforeach
            </tbody>
            @else
            <thead>
                <tr>
                    <th style="text-align: left; font-weight:bold ;font-size: 24px" colspan="{{ $range_date+8 }}">
                        Laporan Absensi Bulan : {{
                        $request['month'] }}</th>
                </tr>
                <tr>
                    <th scope="col" rowspan="2" class="align-middle">No</th>
                    <th scope="col" rowspan="2" class="align-middle">NISN</th>
                    <th scope="col" rowspan="2" class="align-middle">Nama</th>
                    <th scope="col" rowspan="2" class="align-middle">L/P</th>
                    <th scope="col" rowspan="2" class="align-middle">Kelas</th>
                    <th scope="col" colspan="{{ $range_date }}" class="text-center">Tanggal</th>
                    <th scope="col" colspan="3" class="text-center">Total</th>
                </tr>
                <tr>
                    @for ($i=1; $i<= $range_date; $i++) @php if ($i<10) { $i='0' .$i; } $date=date('Y-m-').$i; @endphp
                        <th class="@if (date('D', strtotime($date))=='Sun' ) bg-danger text-white @endif"> {{ $i }}
                        </th>
                        @endfor
                        <th class="">H</th>
                        <th class="bg-warning">I</th>
                        <th class="bg-danger text-white">A</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absents as $abs)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $abs->nisn }}</td>
                    <td>{{ $abs->name }}</td>
                    <td>{{ucFirst(substr($abs->gender, 0,1))}}</td>
                    <td></td>
                    @for ($i=1; $i<= $range_date; $i++) @php if ($i<10) { $i='0' .$i; } $date=date('Y-m-').$i;
                        @endphp<td @if (date('D', strtotime($date))=='Sun' ) class="bg-danger text-white" @endif>
                        @foreach ($absentions as $absention)
                        @if ($abs->student_id==$absention->student_id)
                        @if ($absention->day ==$i)
                        @if ($absention->attend)
                        H
                        @elseif($absention->permit)
                        I
                        @elseif($absention->alpha)
                        A
                        @endif
                        @endif
                        @endif
                        @endforeach
                        </td>
                        @endfor
                        <td>{{ $abs->attend_total }}</td>
                        <td>{{ $abs->permit_total }}</td>
                        <td>{{ $abs->alpha_total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <table class="table table-bordered w-25">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Absensi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>H</td>
                    <td>Hadir</td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>I</td>
                    <td>Izin</td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>A</td>
                    <td>Alfa</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>