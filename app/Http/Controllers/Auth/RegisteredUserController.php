<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $filieres = Module::select('filiere_name')->distinct()->pluck('filiere_name');
        return view('auth.register', ['filieres' => $filieres]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'filiere'  => ['required', 'string', 'max:10'],
            'year'     => ['required', 'integer', 'min:1', 'max:3'],
            'profile_picture_type' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]
        );

        $user = User::create([
            'username' => $request->username,
            'filiere'  => $request->filiere,
            'year'  => $request->year,
            'profile_picture_type'  => 1,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('welcome', absolute: false));
    }
}
