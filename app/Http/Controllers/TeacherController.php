<?php

namespace App\Http\Controllers;

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
        $subjects = '';
        return view('dashboard.teachers.create', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $teacher->id = $teacher->count() + 1;
        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->password = password_hash($request->password, PASSWORD_BCRYPT);
        $teacher->status = $request->status;

        if ($request->status === 2) {
            $teacher->class = $request->class;
        }
        if ($request->subjects) {
            $teacher->subjects = $request->subjects;
        }

        $teacher->save();
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
        return view('dashboard.teachers.edit', compact(['title', 'teacher']));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
