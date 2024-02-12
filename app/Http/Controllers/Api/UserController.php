<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function myProfile($id)
    {
        $user = User::with('posts')->find($id);
        return response()->json([
            'details' => $user
        ]);
    }
}
