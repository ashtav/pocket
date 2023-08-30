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

class DashboardController extends Controller
{
    public function index()
    {
        // count total student
        $total_student = Student::count();

        // count total saving
        $total_saving = Saving::sum('amount');
        
        // count total expense
        $total_expense = Expense::sum('amount');

        $data = [
            'total_student' => $total_student,
            'total_saving' => $total_saving - $total_expense,
            'total_expense' => $total_expense,
        ];
        
        return view('dashboard', compact('data'));
    }
}
