<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login (Request $request) {
        $incomingFields = $request->validate([
            'loginemail' => ['required'],
            'loginpassword' => ['required']
        ]);

        if (auth()->attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout () {
        auth()->logout();
        return redirect('/');
    }

    public function register (Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required','min:2', 'max:50', Rule::unique('users', 'name')],
            'email' => ['required','min:2', 'max:50', 'email', Rule::unique('users', 'email')],
            'password' => ['required','min:6', 'max:100']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }
}
