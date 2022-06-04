<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){

        $rules = [
            'name'  => ['required', 'regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/', 'unique:users'],
            'email' => ['required', 'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/','unique:users'],
            'password' => ['required', 'regex:/^.{4,12}$/', 'confirmed'],
        ];
        $customMessages = [
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.regex' => 'Solo se admiten letras (a-z ó A-Z) y acentos.',
            'email.required' => 'El campo Correo electrónico es obligatorio.',
            'email.regex' =>$request->email.' no es una dirección de correo válida.',
            'email.unique' => 'El correo '.$request->email.' ya está en uso.',
            
            'rfc.required' => 'El campo RFC es obligatorio.',
            'rfc.regex' => 'No ingreso un dato válido en el campo RFC',
            'rfc.unique' => 'El correo '.$request->rfc.' ya está en uso.',

            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.regex' => 'La contraseña debe contener 4 a 12 digitos',
            'password.confirmed' => 'El campo Confirmar Contraseña no coincide, intente de nuevo.',
        ];

        // $request->validate([
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $request->validate($rules, $customMessages);

        $user = User::create([
            'name' => $request->name,
            'rfc' => $request->rfc,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
