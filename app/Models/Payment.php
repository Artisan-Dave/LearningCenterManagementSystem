<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'full_name',
        'amount',
        'total_balance'
        
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
    