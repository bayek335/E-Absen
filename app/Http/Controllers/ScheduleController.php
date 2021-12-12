<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $title = 'Jadwal | Dashboard';
        $schedule = new Schedule();
        $schedules = $schedule->getSchedulesIndex(1)->get();
        return view('dashboard.schedules.index', compact(['title', 'schedules']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah |dashboard';
        $days = Day::all();
        $subjects = Subject::all();
        return view('dashboard.schedules.create', compact(['title', 'days', 'subjects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'day[]' => 'required'
        // ]);

        for ($i = 0; $i < count($request->day); $i++) {
            $schedule = new Schedule();
            if ($schedule->where('class_id', '2')->where('day_id', $request->day[$i])->where('o_clock', $request->clock[$i])->first()) {
                return back()->with('fail', 'Data yang anda masukkan telah ditemukan!. Pilih menu <strong>Ubah</strong> untk memperbaruinya.');
            } else {
                $schedule->class_id = 2;
                $schedule->day_id = $request->day[$i];
                $schedule->subject_id = $request->subject[$i];
                $schedule->o_clock = $request->clock[$i];
                $schedule->start = 7;
                $schedule->end = 1200;
                $schedule->save();
            }
        }
        Cookie::queue(Cookie::forget('create_schedule_row'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($day_id, $class_id)
    {
        $title = 'Detail Jadwal Pelajaran | Dashboard';
        $schedule = new Schedule();
        $schedules = $schedule->getSchedules()->where('day_id', $day_id)->where('class_id', $class_id)->get();
        return view('dashboard.schedules.show', compact(['title', 'schedules']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($day_id = null, $class_id = null, $id = null)
    {
        if ($class_id && $day_id) {
            return $class_id . $day_id;
        }
        return response()->json(['status' => 'succes']);
    }
}
