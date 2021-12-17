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
        $title = 'Tambah | Dashboard';
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
        $request->validate([
            'day' => 'required|array',
            'day.*' => 'required|string',
            'clock' => 'required|array',
            'clock.*' => 'required|min:1|max:12|numeric|distinct',
            'subject' => 'required|array',
            'subject.*' => 'required|string',
        ]);

        for ($i = 0; $i < count($request->day); $i++) {
            $schedule = new Schedule();
            if ($schedule->where('class_id', '1')->where('day_id', $request->day[$i])->where('o_clock', $request->clock[$i])->first()) {
                return back()->with('fail', 'Data yang anda masukkan telah ditemukan!. Pilih menu <strong>Ubah</strong> untk memperbaruinya.');
            } else {
                $schedule->class_id = 1;
                $schedule->day_id = $request->day[$i];
                $schedule->subject_id = $request->subject[$i];
                $schedule->o_clock = $request->clock[$i];
                $schedule->start = 7;
                $schedule->end = 1200;
                $schedule->save();
            }
        }
        return redirect()->to('/dashboard/schedules/')->with('success', "Data berhasil ditambahkan<i class='bi bi-check-lg'></i>.");
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
    public function edit($day_id, $class_id)
    {
        $title = 'Perbarui Jadwal | Dashboard';
        $days = Day::all();
        $subjects = Subject::all();
        $schedules = new Schedule();
        $schedule = $schedules->getSchedules()->where('day_id', $day_id)->where('class_id', $class_id)->get();
        return view('dashboard.schedules.edit', compact(['title', 'schedule', 'days', 'subjects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $day_id, $class_id)
    {
        $request->validate([
            'day' => 'required|array',
            'day.*' => 'required|string',
            'clock' => 'required|array',
            'clock.*' => 'required|min:1|max:12|numeric|distinct',
            'subjects' => 'required|array',
            'subjects.*' => 'required|string',
        ]);
        for ($i = 0; $i < count($request->schedule_id); $i++) {
            $schedule = Schedule::find($request->schedule_id[$i]);
            $schedule->subject_id = $request->subjects[$i];
            $affected =  $schedule->save();
        }
        if ($affected) {
            return redirect('/dashboard/days/' . $day_id . '/classes/' . $class_id)->with('success', 'Data berhasil diperbarui');
        } else {
            return back()->with('fail', 'Terjadi kesalahn saat menyimpan data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($schedule_id)
    {
        Schedule::destroy($schedule_id);
        return response()->json(['status' => 'success']);
    }

    public function destroyAll($day_id, $class_id)
    {
        if ($class_id && $day_id) {
            Schedule::where('day_id', $day_id)->where('class_id', $class_id)->delete();
            return redirect()->to('/dashboard/schedules')->with('success', "Data berhasil dihapus<i class='bi bi-check-lg'></i>.");
        } else {
            return back()->with('fail', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
