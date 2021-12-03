<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Status;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = "teachers";
        $teachers = Teacher::latest()->paginate(10);
        return view('dashboard.teachers.index', compact(['title', 'teachers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Data Guru";
        $subjects = Subject::all();
        $status = Status::all();
        $classes = ClassModel::all();
        return view('dashboard.teachers.create', compact(['title', 'subjects', 'status', 'classes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjects = explode(',', $request->subjects);
        $rules = [
            'name' => 'required|max:64',
            'username' => 'required|unique:teachers|max:64',
            'password' => 'required|min:8',
            'status' => 'required',
        ];
        if ($request->status == 2) {
            $rules['class'] = 'required|min:1|max:1';
        }
        $request->validate($rules);

        $teacher = new Teacher();
        $subject_teacher = new SubjectTeacher();

        $teacher->id = $teacher->count() + 1;
        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->password = password_hash($request->password, PASSWORD_BCRYPT);
        $teacher->status_id = $request->status;
        if ($request->status == 2) {
            $teacher->class_id = $request->class;
        }

        $teacher->save();
        if ($request->subjects) {
            for ($i = 0; $i < count($subjects); $i++) {
                $subject_from_db = Subject::where('name', $subjects[$i])->first();
                $subject_teacher->create([
                    'subject_id' => $subject_from_db->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }
        // if ($teacher->row)
        return redirect()->to('/dashboard/teachers')->with('success', "Data guru berhasil ditambahkan <i class='bi bi-check-lg'></i>");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $title = 'Detail Guru | ';
        return view('dashboard.teachers.show', compact(['title', 'teacher']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $title = "Edit data guru";
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $status = Status::all();
        return view('dashboard.teachers.edit', compact(['title', 'teacher', 'classes', 'subjects', 'status']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $subject_teacher = new SubjectTeacher();
        $teacher = Teacher::find($teacher->id);

        $subjects = explode(',', $request->subjects);

        $rules = [
            'name' => 'required|max:64',
            'status' => 'required',
        ];
        if ($request->status == 2) {
            $rules['class'] = 'required|min:1|max:1';
        }
        $request->validate($rules);

        $teacher->name = $request->name;
        $teacher->status_id = $request->status;

        if ($request->status == 2) {
            $teacher->class_id = $request->class;
        } else {
            $teacher->class_id = 0;
        }

        $subject_teacher->where('teacher_id', $teacher->id)->delete();

        if ($request->subjects) {
            for ($i = 0; $i < count($subjects); $i++) {
                $subject_from_db = Subject::where('name', $subjects[$i])->first();
                $subject_teacher->create([
                    'subject_id' => $subject_from_db->id,
                    'teacher_id' => $teacher->id,
                ]);
            }
        }

        $teacher->save();

        return redirect()->to('/dashboard/teachers')->with('success', "Data guru berhasil perbarui <i class='bi bi-check-lg'></i>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        Teacher::destroy($teacher->id);
        SubjectTeacher::where("teacher_id", $teacher->id)->delete();

        return response()->json([
            'status' => 'succes',
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
