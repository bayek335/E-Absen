<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absent;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class AbsentController extends Controller
{

    protected $desc = [
        'attend' => 1,
        'permit' => 2,
        'alpha' => 3,
    ];

    protected $select = ['absents.id as absent_id', 'nisn', 'name', 'attend_date', 'enter', 'out', 'attend', 'permit', 'alpha', 'class_id', 'student_id'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Absensi | Dashboard';
        $classes = ClassModel::all();
        $absents = [];

        if ($request->ajax()) {
            $absents = Absent::getAbsents($this->select)->where('class_id', $request->class)->paginate(16);

            return view('dashboard.absents.ajax_index', compact(['title', 'classes', 'absents']));
        }
        if ($request->class) {
            $absents = Absent::getAbsents($this->select)->where('class_id', $request->class)->paginate(16);
            return view('dashboard.absents.index', compact(['title', 'classes', 'absents']));
        }
        // ddd($absents);
        return view('dashboard.absents.index', compact(['title', 'classes', 'absents']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Absensi | Dashboard';
        $students = Student::where('class_id', 6)->get(['id', 'name']);
        return view('dashboard.absents.create', compact(['title', 'students']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $desc = $this->desc;
        // ddd($request->all());    
        if (!empty($request->desc)) {
            if (count($request->desc) != count($request->student_id)) {
                return back()->with('fail', 'Pastikan telah mengisi keterangan masing-masing siswa.');
            }
        } else {
            return back()->with('fail', 'Pastikan telah mengisi keterangan masing-masing siswa.');
        }
        try {
            foreach ($request->desc as $key => $value) {
                $find = Absent::where('student_id', $request->student_id[$key - 1])->where('attend_date', date('Y-m-d'))->get();
                if (count($find) < 1) {
                    $absent = new Absent();
                    $absent->student_id = $request->student_id[$key - 1];
                    $absent->attend_date = date('Y-m-d');
                    $absent->enter = date('H:i:s');
                    $desc_key =  array_search($value, $desc);
                    $absent->$desc_key = 1;
                    $absent->save();
                } else {
                    return back()->with('fail', 'Absensi siswa pada ' . date('Y-m-d') . ' telah ditemukan pilih <strong>Ubah</strong> untuk memperbaruinya.');;
                }
            }
            return redirect()->to('/dashboard/absents')->with('success', "Absensi berhasil ditambahkan<i class='bi bi-check-lg'></i>");
        } catch (\Throwable $th) {
            return back()->with('fail', 'Terjadi kesalahan saat memasukkan data. ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id, $attend_date)
    {
        $title = "Perbarui Absensi | Dashboard";
        $absents = Absent::getAbsents($this->select)->where('class_id', $class_id)->where('attend_date', $attend_date)->get();
        return view('dashboard.absents.edit', compact(['title', 'absents']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        foreach ($this->desc as $key => $desc) {
            if ($this->desc[$key] == $request->desc) {
                $absent->$key = $request->desc;
            } else {
                $absent->$key = NULL;
            }
        }
        $absent->out = $request->out;
        $absent->save();

        return redirect()->to('/dashboard/absents?class=' . $request->class);
    }

    public function updateAll(Request $request)
    {
        $request->validate([
            'desc' => 'required|array',
            'desc.*' => 'required|string',
            'out' => 'required|array',
            'out.*' => 'required|string',
        ]);
        foreach ($request->absent_id as $key_absent => $id) {
            $absent = Absent::find($id);
            foreach ($this->desc as $key => $desc) {
                if ($this->desc[$key] == $request->desc[$key_absent]) {
                    $absent->$key = $request->desc[$key_absent];
                } else {
                    $absent->$key = NULL;
                }
            }
            $absent->out = $request->out[$key_absent];
            $absent->save();
        }
        return redirect()->to('/dashboard/absents?class=' . $request->class_id)->with('success', "Absensi berhasil diperbarui<i class='bi bi-check-lg'></i>.");
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //
    }
}
