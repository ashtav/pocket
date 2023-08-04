<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Saving extends Model
{
    use HasFactory;

    protected $table = "savings";
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

    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value, 'UTC')
            ->timezone('Asia/Singapore');
    }
}
