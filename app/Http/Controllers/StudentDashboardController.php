<?php

namespace App\Http\Controllers;

use App\Imports\studentsImport;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\SecondaryPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class StudentDashboardController extends Controller
{

    protected $default_img_name = 'images/profile_images/default-profile-picture.png';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $title = 'Students';

        if ($request->lim) {
            $limit = $request->lim;
        }
        $classes = ClassModel::orderBy('class', 'asc')->get();
        $students = Student::filters(request(['name', 'class', 'gender']))->orderBy('class_id')->orderBy('name')->paginate($limit);

        if ($request->ajax()) {
            return view('dashboard.students.ajax_index', compact(['title', 'students', 'classes']));
        }
        return view('dashboard.students.index', compact(['title', 'students', 'classes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Dashboard | Tambah data siswa";
        $classes = ClassModel::all();
        return view('dashboard.students.create', compact(['title', 'classes']));
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
            'nisn' => 'required|unique:students|min:4|numeric',
            'name' => 'required|min:6|max:75',
            'username' => 'required|unique:students|min:8',
            'password' => 'required|min:8',
            'gender' => [
                'required',
                Rule::in(['laki-laki', 'perempuan'])
            ],
            'class' => 'required|',
        ]);

        $student = new Student();
        $secondary_pwd = new SecondaryPassword();

        $student->nisn = $request->nisn;
        $student->name = $request->name;
        $student->username = $request->username;

        $hashing_pwd = password_hash($request->password, PASSWORD_BCRYPT);

        $student->password = $hashing_pwd;
        $student->gender = $request->gender;
        $student->class_id = $request->class;
        $student->status_id = 4;
        $student->image = $this->default_img_name;

        $student->save();
        try {
            $secondary_pwd->create([
                'student_id' => $student->id,
                'secondary_password' => $request->password,
            ]);
        } catch (Throwable $e) {
            $student->delete($student->id);
            return back()->with('fail', 'Terjadi kesalahan saat menyimpan data');
        }
        return redirect()->to('/dashboard/students')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $title = 'Detail | Dashboard';
        return view('dashboard.students.show', compact(['title', 'student']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $title = "Dashboard | Perbarui data siswa";
        $classes = ClassModel::all();
        return view('dashboard.students.edit', compact(['title', 'student', 'classes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {

        $rule = [
            'name' => 'required|min:6|max:75',
            'password' => 'required|min:8',
            'gender' => [
                'required',
                Rule::in(['laki-laki', 'perempuan'])
            ],
            'class' => 'required|',
        ];

        if ($student->nisn == $request->nisn) {
            $rule['nisn'] = 'required|min:4|numeric';
            $rule['username'] = 'required|min:8';
        } else {
            $rule['nisn'] = 'required|unique:students|min:4|numeric';
            $rule['username'] = 'required|unique:students|min:8';
        }

        $request->validate($rule);

        $secondary_pwd = SecondaryPassword::where('student_id', $student->id)->first();

        $student->nisn = $request->nisn;
        $student->name = $request->name;
        $student->username = $request->username;

        $hashing_pwd = password_hash($request->password, PASSWORD_BCRYPT);

        $student->password = $hashing_pwd;
        $student->gender = $request->gender;
        $student->class_id = $request->class;

        try {
            $secondary_pwd->student_id = $student->id;
            $secondary_pwd->secondary_password = $request->password;

            $secondary_pwd->save();
        } catch (Throwable $e) {

            ddd($e);
            return back()->with('fail', 'Terjadi kesalahan saat menyimpan data');
        }
        $student->save();
        return redirect()->to('/dashboard/students')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            Student::where('nisn', $student->nisn)->delete();
            SecondaryPassword::where('student_id', $student->id)->delete();
            Storage::delete($student->image);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'message' => 'Data berhasil dihapus'
                ]
            ]);
        } catch (\Throwable $th) {
            if (count(Student::where('id', $student->id)->get()) <= 0) {
                Student::create([
                    'id' => $student->id,
                    'nisn' => $student->nisn,
                    'name' => $student->name,
                    'username' => $student->username,
                    'password' => $student->password,
                    'image' => $student->image,
                    'class_id' => $student->class_id,
                    'gender' => $student->gender,
                    'created_at' => $student->created_at,
                    'updated_at' => $student->updated_at,
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => [
                    'message' => 'Terjadi kesalahan saat mengirim data!'
                ]
            ]);
        }
    }


    public function uploadImage(Request $request, Student $student)
    {

        // $file_name = $request->file(('image'))->getClientOriginalName();
        // $img_name = time() . $file_name;
        // $new_name = preg_replace('/[^a-z0-9]/i', '_', $img_name);
        $mimes = explode('/', $request->file('image')->getMimeType());

        if ($mimes[0] == 'image') {

            if ($student->image != $this->default_img_name) {
                Storage::delete($student->image);
            }
            $image_name = $request->file('image')->store('images/profile_images');
            $student = Student::find($student->id);
            $student->image = $image_name;
            $student->save();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'suorce' => $image_name,
                ],
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => [
                    'message' => 'File input must be <strong>Image</strong>!.'
                ],
            ]);
        }
    }


    // Import file
    public function import(Request $request)
    {

        $request->validate(
            [
                'class' => 'required|',
                'excel' => 'required|file|mimes:csv,xls,xlsx'
            ]
        );

        $file = $request->file('excel');



        // ddd($file);
        // $filename = rand() . $file->getClientOriginalName();

        Excel::import(new studentsImport($request->class), $file);

        return redirect()->to('/dashboard/students')->with('success', "Data berhasil di-Impor ");
    }
}
