<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getLastSavingDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value, 'UTC')
            ->timezone('Asia/Singapore')
            ->toDateTimeString();  // Atau format lain yang Anda inginkan
    }
}
