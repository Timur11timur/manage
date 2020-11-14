<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

class RegisterConformationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))
            ->first();

        if (is_null($user)) {
            return redirect(route('threads'))
                ->with('flash', 'Unknown token.');
        }

        $user->confirm();

        return redirect(route('threads'))
            ->with('flash', 'Your account is now confirmed! You may post to the forum.');
    }
}
