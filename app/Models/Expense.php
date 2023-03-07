<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = "expenses";
    protected $fillable = [
        'student_id',
        'date',
        'amount',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
