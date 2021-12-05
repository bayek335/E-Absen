<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kelas';
        $classes = ClassModel::orderBY('class', 'asc')->get();
        return view('dashboard.classes.index', compact(['title', 'classes']));
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
            'name' => 'required|unique:classes',
            'roman' => 'required|unique:classes',
        ];

        $request->validate($rules);

        ClassModel::create($request->all());
        return redirect()->to('/dashboard/classes')->with('success', 'Kelas berhasil ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Class  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassModel $class)
    {
        return response()->json([
            'status' => 'success',
            'data' => $class,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Class  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassModel $class)
    {
        $rules = [
            'name' => 'required|unique:classes',
            'roman' => 'required|unique:classes',
        ];

        $request->validate($rules);

        $data = [
            'class' => $request->class,
            'name' => $request->name,
            'roman' => $request->roman,
        ];
        ClassModel::where('id', $class->id)->update($data);

        return redirect()->to('/dashboard/classes')->with('success', 'Data berhasil dperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Class  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassModel $class)
    {
        try {

            ClassModel::destroy($class->id);
            return response()->json([
                'status' => 'success',
            ])->status(200);
        } catch (Throwable $e) {
            return response()->json(['status' => 'succes'])->status(500);
        }
    }
}
