<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'student_id',
        'full_name',
        'amount',
        'total_balance'
        
    ];
}
