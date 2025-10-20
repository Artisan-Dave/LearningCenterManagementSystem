<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'full_name',
        'total_balance'
    ];

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
