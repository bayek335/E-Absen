<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>

    <style>
        tr,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <table>
        @if ($one_year)
        <thead>
            <tr>
                <th style="text-align: left; font-weight:bold ;font-size: 24px" colspan="{{ count($month)+8 }}">
                    Laporan Absensi Tahun : {{
                    $request['year'] }}</th>
            </tr>
            <tr style="vertical-align: middle; font-weight: bold">
                <th style="text-align: left" scope="col" rowspan="2">No</th>
                <th scope="col" rowspan="2" style="align-items: center; font-weight: bold">NISN</th>
                <th scope="col" rowspan="2" style="align-items: center; font-weight: bold">Nama</th>
                <th scope="col" rowspan="2" style="align-items: center; font-weight: bold;text-align: center">L/P</th>
                <th scope="col" rowspan="2" style="align-items: center; font-weight: bold">Kelas</th>
                <th scope="col" colspan="{{ count($month) }}" style="text-align: center; font-weight: bold">Bulan</th>
                <th scope="col" colspan="3" style="text-align:center; font-weight: bold">Total</th>
            </tr>
            <tr>
                @for ($i=0; $i<count($month); $i++) <th style="font-weight: bold; text-left; width:45px">
                    {{ ucFirst($month[$i])}}
                    </th>
                    @endfor
                    <th class="" style="text-align: center">H</th>
                    <th style="background-color: yellow; text-align:center">I</th>
                    <th style="background-color: red;text-align:center">A</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absents as $abs)
            <tr>
                <th style="text-align: left" scope="row">{{ $loop->iteration }}</th>
                <td style="text-align: left">{{ $abs->nisn }}</td>
                <td style="text-align: left">{{ $abs->name }}</td>
                <td style="text-align: center">{{ucFirst(substr($abs->gender, 0,1))}}</td>
                <td style="text-align: left"></td>
                @php
                $attend=0;
                $permit=0;
                $alpha=0;
                @endphp
                @for ($i = 1; $i < count($month)+1; $i++)<td>
                    @foreach ($countAttendYear as $countAttend)
                    @if ($countAttend->student_id == $abs->student_id && $countAttend->month == $i)
                    {{ $countAttend->attend_total }}
                    @php
                    $attend += $countAttend->attend_total;
                    $permit += $countAttend->permit_total;
                    $alpha += $countAttend->alpha_total;
                    @endphp
                    @php
                    @endphp
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
        <br>
        @else
        <thead>
            <tr>
                <th style="text-align: left; font-weight:bold ;font-size: 24px" colspan="{{ $range_date+8 }}">
                    Laporan Absensi Bulan : {{
                    $request['month'] }}</th>
            </tr>
            <tr style="vertical-align: middle; font-weight: bold">
                <th scope="col" rowspan="2" style="font-weight: bold">No</th>
                <th scope="col" rowspan="2" style="font-weight: bold">NISN</th>
                <th scope="col" rowspan="2" style="font-weight: bold">Nama</th>
                <th scope="col" rowspan="2" style="font-weight: bold; text-align: center">L/P</th>
                <th scope="col" rowspan="2" style="font-weight: bold">Kelas</th>
                <th scope="col" colspan="{{ $range_date }}" style="text-align: center; font-weight:bold">Tanggal</th>
                <th scope="col" colspan="3" style="text-align: center; font-weight:bold">Total</th>
            </tr>
            <tr>
                @for ($i=1; $i<= $range_date; $i++) @php if ($i<10) { $i='0' .$i; } $date=date('Y-m-').$i; @endphp <th
                    style="width:20px; font-weight:bold;@if (date('D', strtotime($date))=='Sun' ) background-color: red; @endif">
                    {{ $i
                    }}
                    </th>
                    @endfor
                    <th style="width:20px">H</th>
                    <th style="background-color: yellow;width:20px">I</th>
                    <th style="background-color: red;width:20px">A</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absents as $abs)
            <tr style="text-align: left">
                <th scope="row">{{ $loop->iteration }}</th>
                <td style="text-align: left">{{ $abs->nisn }}</td>
                <td style="text-align: left">{{ $abs->name }}</td>
                <td style="text-align: center">{{ucFirst(substr($abs->gender, 0,1))}}</td>
                <td></td>
                @for ($i=1; $i<= $range_date; $i++) @php if ($i<10) { $i='0' .$i; } $date=date('Y-m-').$i; @endphp <td
                    @if(date('D', strtotime($date))=='Sun' ) style="background-color: red;" @endif>
                    @foreach ($absentions as $absention)
                    @if ($absention->day==$i && $abs->student_id==$absention->student_id)
                    @if ($absention->attend)
                    H
                    @elseif($absention->permit)
                    I
                    @elseif($absention->alpha)
                    A
                    @endif
                    @endif
                    @endforeach
                    </td>
                    @endfor
                    <td style="text-align: center">{{ $abs->attend_total }}</td>
                    <td style="text-align: center">{{ $abs->permit_total }}</td>
                    <td style="text-align: center">{{ $abs->alpha_total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif



    <table style="border: 1px solid black; margin-top:40px">
        <thead>
            <tr>
                <th>No</th>
                <th>Absensi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align: left">1</th>
                <td style="text-align: left">H</td>
                <td style="text-align: left">Hadir</td>
            </tr>
            <tr>
                <th style="text-align: left">2</th>
                <td style="text-align: left">I</td>
                <td style="text-align: left">Izin</td>
            </tr>
            <tr>
                <th style="text-align: left">3</th>
                <td style="text-align: left">A</td>
                <td style="text-align: left">Alfa</td>
            </tr>
        </tbody>
    </table>
</body>

</html>