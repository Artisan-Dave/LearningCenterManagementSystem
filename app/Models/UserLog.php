<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'route',
        'url',
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    protected $dates = [
        'visited_at'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

      // Automatically truncate URL before saving
    public static function booted()
    {
        static::creating(function ($log) {
            // Limit to 500 characters (adjust as needed)
            if (strlen($log->url) > 500) {
                $log->url = substr($log->url, 0, 500);
            }
        });
    }
    
}
