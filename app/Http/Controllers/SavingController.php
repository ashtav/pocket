<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Models\Saving;
use App\Models\Student;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Saving::all();
        return view('saving.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('saving.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavingRequest $request)
    {
        $data = Saving::create(array_merge($request->validated(), ['date' => now()]));
        return redirect()->route('savings.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Saving::find($id);
        $students = Student::all();
        return view('saving.edit', compact('data', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingRequest $request, $id)
    {
        Saving::find($id)->update($request->validated());
        return redirect()->route('savings.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Saving::find($id)->delete();
        return redirect()->route('savings.index')->with('success', 'Data berhasil dihapus!');
    }

    public function getSavingInDay()
    {
        $studentId = request()->get('student_id');
        $date = request()->get('date');

        $totalSavingInDay = Saving::where('student_id', $studentId)->whereDate('created_at', $date)->sum('amount');
        return response()->json('Rp ' . number_format($totalSavingInDay, 2));
    }

    public function getSavingInMonth()
    {
        $studentId = request()->get('student_id');
        $date = request()->get('date'); // 2023-02

        $month = explode('-', $date)[1];
        $year = explode('-', $date)[0];

        $totalSavingInMonth = Saving::where('student_id', $studentId)->whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('amount');
        return response()->json('Rp ' . number_format($totalSavingInMonth, 2));
    }
}
