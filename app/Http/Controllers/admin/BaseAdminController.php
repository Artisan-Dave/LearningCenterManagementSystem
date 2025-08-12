<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BaseAdminController extends Controller
{
    public function __construct()
    {
        if (Auth::check() && Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized access');
        }
    }
}
