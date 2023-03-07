<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\StoreSavingRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Requests\UpdateSavingRequest;
use App\Models\Expense;
use App\Models\Saving;
use App\Models\Student;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Expense::whereHas('student', function ($query) {
            $query->where('nisn', auth()->user()->nisn);
        })->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('expense.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request, $id)
    {
        $balance = (Saving::where('student_id', $id)->sum('amount')) - (Expense::where('student_id', $id)->sum('amount'));
        if ($request->amount > $balance) {
            return redirect()->route('students.show', $id)->with('failed', 'Tabungan tidak mencukupi!');
        }
        $data = Expense::create(array_merge($request->validated(), ['date' => now(), 'student_id' => $id]));
        return redirect()->route('students.show', $id)->with('success', 'Data berhasil disimpan!');
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
        $student = Student::find($id);
        $data = Expense::find($id);
        return view('expense.edit', compact('data', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, $id)
    {
        $expense = Expense::find($id);
        Expense::find($id)->update($request->validated());
        return redirect()->route('students.show', $expense->student_id)->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('students.index')->with('success', 'Data berhasil dihapus!');
    }
}
