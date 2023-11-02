<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        
        if($user){
            return response()->json([
                'success'   => true,
                'results'   => $user
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'results'   => $user
            ]);
        }
        
    }
}