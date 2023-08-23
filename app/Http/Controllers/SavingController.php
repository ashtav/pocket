<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Models\Saving;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{

    public function index()
    {
        $datas = Student::select('students.id', 'students.name', 'students.nis')
            ->addSelect([
                'total_savings' => DB::table('savings')
                    ->selectRaw('SUM(amount)')
                    ->whereColumn('students.id', 'savings.student_id')
                    ->groupBy('savings.student_id'),
                'total_expenses' => DB::table('expenses')
                    ->selectRaw('SUM(amount)')
                    ->whereColumn('students.id', 'expenses.student_id')
                    ->groupBy('expenses.student_id'),
                'last_saving_date' => DB::table('savings')
                    ->selectRaw('MAX(created_at)')
                    ->whereColumn('students.id', 'savings.student_id')
                    ->groupBy('savings.student_id'),
            ])
            ->withCasts([
                'total_savings' => 'integer',
                'total_expenses' => 'integer',
                'last_saving_date' => 'datetime'
            ])
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('savings')
                    ->whereColumn('students.id', 'savings.student_id');
            })
            ->get();

        // Add 'total' field to each data point
        foreach ($datas as $data) {
            $data->total = $data->total_savings + $data->total_expenses;
        }

        $datas = $datas->sortByDesc('last_saving_date')->values();

        return view('saving.index', compact('datas'));
    }


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
