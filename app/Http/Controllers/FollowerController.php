<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function followUnfollow(Request $request, User $user){
       $follower = $request->user();
        $user->followers()->toggle($follower->id);

        return response()->json(['followersCount' => $user->followers()->count()]);
        

    }
}