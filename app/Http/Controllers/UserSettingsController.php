<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nuevaContraseña()
    {
        return view('auth.settings-profile');
    }
    public function cambiarContraseña(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $userRFC = $user->rfc;
        $userEmail = $user->email;
        $userPassword = $user->password;

        if($request->passwordActual != ""){
            $newPassword = $request->password;
            $confirmPassword = $request->password_confirmation;
            $name = $request->name;
            $rfc = $request->rfc;
            $direccion = $request->direccion;
            $website = $request->website;
            $telefono = $request->telefono;

            if (Hash::check($request->passwordActual, $userPassword)) {

                if ($newPassword == $confirmPassword) {

                    if (strlen($newPassword >= 4)) {

                        $user->password = Hash::make($request->password);
                        
                        $sqlDB =  DB::table('users')
                                    ->where('id', $user->id)
                                    ->update(
                                        ['password' => $user->password]
                                        , ['name' => $user->name]
                                        , ['rfc' => $user->rfc]
                                        , ['direccion' => $user->direccion]
                                        , ['website' => $user->website]
                                        , ['telefono' => $user->telefono]
                                    );

                        return redirect()->back()->with('updateClave', '¡La contraseña se actualizo con exito!');
                        // dd("La contraseña se actualizo con exito!");
                    }else{
                        return redirect()->back()->with('claveMenor', 'Recuerde que la clave debe ser mayor a 4 digitos.');
                        // dd("Recuerde que la clave debe ser mayor a 4 digitos.");
                    }
                }else{
                    return redirect()->back()->with('errorClave', 'Por favor verifique las claves no coinciden');
                    // dd("Por favor verifique las claves no coinciden");
                }
            }
            else{
                return back()->withErrors(['passwordActual' => 'Las contraseñas no coinciden']);
                // dd("Las contraseñas no coinciden");
            }
        }else{
            $updatePerfil = User::where('id', '=', $userId)->first();

            $rules = [
                'name'  => ['required', 'regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
                'rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/', 'unique:users'],
                'direccion'  => ['required'],
                'website'  => ['required'],
                'telefono'  => ['required'],
            ];
            $customMessages = [
                'name.required' => 'El campo Nombre es obligatorio.',
                'name.regex' => 'Solo se admiten letras (a-z ó A-Z) y acentos.',
                
                
                'rfc.required' => 'El campo RFC es obligatorio.',
                'rfc.regex' => 'No ingreso un dato válido en el campo RFC',
                'rfc.unique' => 'El RFC '.$request->rfc.' ya está en uso.',

                'direccion.required' => 'El campo Direccion es obligatorio.',
                'website.required' => 'El campo Sitio Web es obligatorio.',
                'telefono.required' => 'El campo Telefono es obligatorio.',

            ];

            $data = $request->validate($rules, $customMessages);

            $updatePerfil->name = $data['name'];
            $updatePerfil->rfc = $data['rfc'];
            $updatePerfil->direccion = $data['direccion'];
            $updatePerfil->website = $data['website'];
            $updatePerfil->telefono = $data['telefono'];
            $updatePerfil->update();
            // return dd($updatePerfil);
            return redirect()->back()->with('datos', 'Los datos se actualizaron con exito.');
            // return dd('Los datos se actualizaron con exito.');
        }

    }

    public function palindromas(){
       

        return view('auth.palindromas');
    }
}
