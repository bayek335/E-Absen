<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use Illuminate\Http\Request;
use App\Exports\AbsentsExport;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    protected $month_array = [
        'januari',
        'februari',
        'maret',
        'april',
        'mei',
        'juni',
        'juli',
        'agustus',
        'september',
        'oktober',
        'november',
        'desember'
    ];

    public function index(Request $request)
    {

        $date_year = date('Y');
        $date_month = date('m');

        $reports = Absent::getReports(request(['year', 'month']));
        $data = [
            'title' => 'Laporan | Dashboard',
            'range_date' => cal_days_in_month(CAL_GREGORIAN, date($date_month), date($date_year)),
            'month' => $this->month_array,
            'one_year' => 0,
            'request' => ['year' => $request->year, 'month' => $request->month],
            'absents' => $reports['reports']->get(),
            'absentions' => $reports['attend']->get(),
        ];

        if ($request->year != '' && $request->month == '') {
            $data['one_year'] = 1;
            $data['countAttendYear'] = Absent::getCountAttend($request->year)->get();
            // ddd($data['countAttendYear']);
        }


        if ($request->ajax()) {
            if ($request->month) {
                $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($request->month), date($date_year));
            }
            if ($request->years) {
                $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($date_month), date($request->years));
            }
            if ($request->month && $request->years) {
                $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($request->month), date($request->years));
            }
            return view('dashboard.reports.index_ajax', $data);
        }

        return view('dashboard.reports.index', $data);
    }


    // export Absention
    public function export(Request $request)
    {
        $year = '';
        $month = '';
        $class = '';

        if ($request->year) {
            $year = $request->year;
        }
        if ($request->month) {
            $month = $request->month;
        }
        if ($request->class) {
            $class = $request->class;
        }

        return Excel::download(new AbsentsExport($request->year, $request->month), 'laporan-absensi-' . $class . '-' . $year . '-' . $month . '.xlsx');
    }

    // export Students
    public function export_students(Request $request)
    {
        $year = date('Y');
        $class = '';
        if ($request->class) {
            $class = $request->class;
        }

        return Excel::download(new StudentsExport($request->class), 'Daftar-siswa-' . $class . '-' . $year . '.xlsx');
    }
}
