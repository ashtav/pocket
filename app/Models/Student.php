<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    protected $fillable = [
        'nis',
        'name',
        'phone',
        'address',
        'class',
    ];

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
}
