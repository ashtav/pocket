<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Expense;
use App\Models\Saving;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Student::all();
        return view('student.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $data = Student::create($request->validated());
        return redirect()->route('students.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $datas = Expense::where('student_id', $id)->get();
        $balance = (Saving::where('student_id', $id)->sum('amount')) - (Expense::where('student_id', $id)->sum('amount'));

        // get total saving in this day
        $totalSavingInDay = Saving::where('student_id', $id)->whereDate('created_at', date('Y-m-d'))->sum('amount');

        // get total saving in this month
        $totalSavingInMonth = Saving::where('student_id', $id)->whereMonth('created_at', date('m'))->sum('amount');

        // total expense
        $totalExpense = Expense::where('student_id', $id)->sum('amount');
        $totalSaving = Saving::where('student_id', $id)->sum('amount');

        $saving = Saving::where('student_id', $id)->get(); 

        return view('student.detail', compact('student', 'datas', 'balance', 'totalSavingInDay', 'totalSavingInMonth', 'totalExpense', 'totalSaving', 'saving'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Student::find($id);
        return view('student.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        Student::find($id)->update($request->validated());
        return redirect()->route('students.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->route('students.index')->with('success', 'Data berhasil dihapus!');
    }
}
