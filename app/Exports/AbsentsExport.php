<?php

namespace App\Exports;

use App\Models\Absent;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsentsExport implements FromView
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
    protected $request = [];

    public function __construct($year = null, $month = null)
    {
        $this->request['year'] = $year;
        $this->request['month'] = $month;
    }

    public function view(): View
    {
        $date_year = date('Y');
        $date_month = date('m');

        $reports = Absent::getReports(request(['year', 'month']));
        $data = [
            'range_date' => cal_days_in_month(CAL_GREGORIAN, date($date_month), date($date_year)),
            'month' => $this->month_array,
            'one_year' => 0,
            'request' => ['year' => $this->request['year'], 'month' => $this->request['month']],
            'absents' => $reports['reports']->get(),
            'absentions' => $reports['attend']->get(),
        ];

        if ($this->request['year'] != '' && $this->request['month'] == '') {
            $data['one_year'] = 1;
            $data['countAttendYear'] = Absent::getCountAttend($this->request['year'])->get();
        }

        if ($this->request['month']) {
            $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($this->request['month']), date($date_year));
        }
        if ($this->request['year']) {
            $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($date_month), date($this->request['year']));
        }
        if ($this->request['year'] && $this->request['month']) {
            $data['range_date'] = cal_days_in_month(CAL_GREGORIAN, date($this->request['month']), date($this->request['year']));
        }

        return view('dashboard.reports.absent_export', $data);
    }
}
