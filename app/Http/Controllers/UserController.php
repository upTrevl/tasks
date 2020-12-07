<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function notifications()
    {
        $user = Auth::user();
        if (!empty($user->notifications)) {
            return $user->notifications;
        }
    }
}
