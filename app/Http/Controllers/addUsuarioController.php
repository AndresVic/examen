<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class addUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Agenda::where('user_id', Auth::user()->id)->get();
        return view('usuarios.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'  => ['required', 'regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/', 'unique:agendas'],
            'telefono' => ['required'],
            'website' => ['required'],
            'direccion' => ['required'],
        ];
        $customMessages = [
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.regex' => 'Solo se admiten letras (a-z ó A-Z) y acentos.',
            
            'rfc.required' => 'El campo RFC es obligatorio.',
            'rfc.regex' => 'No ingreso un dato válido en el campo RFC',
            'rfc.unique' => 'El correo '.$request->rfc.' ya está en uso.',

            'telefono.required' => 'El campo Telefono es obligatorio.',
            'website.required' => 'El campo Sitio Web es obligatorio.',
            'direccion.required' => 'El campo Direccion es obligatorio.',
        ];

        $request->validate($rules, $customMessages);

        $addUser = new Agenda();
        $addUser->name = $request->input('name');
        $addUser->rfc = $request->input('rfc');
        $addUser->telefono = $request->input('telefono');
        $addUser->website = $request->input('website');
        $addUser->direccion = $request->input('direccion');
        $addUser->user_id = Auth::user()->id;

        if($addUser){
            $addUser->save();
            return redirect()->route('index.usuario')->with('correcto', 'ok');
        }else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = Agenda::whereId($id)->firstOrFail();

        return view('usuarios.edit')
                ->with('usuarios', $usuarios);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $id)
    {
        $rules = [
            'name'  => ['required', 'regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'telefono' => ['required'],
            'website' => ['required'],
            'direccion' => ['required'],
        ];
        $customMessages = [
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.regex' => 'Solo se admiten letras (a-z ó A-Z) y acentos.',

            'telefono.required' => 'El campo Telefono es obligatorio.',
            'website.required' => 'El campo Sitio Web es obligatorio.',
            'direccion.required' => 'El campo Direccion es obligatorio.',
        ];

        $request->validate($rules, $customMessages);

        $id->name = $request->input('name');
        $id->telefono = $request->input('telefono');
        $id->website = $request->input('website');
        $id->direccion = $request->input('direccion');
        $id->user_id = Auth::user()->id;
        
        $id->updated_at = now();

        $id->save();

        return redirect()->route('index.usuario')->with('correcto', 'ok');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Agenda::where('id', '=', $id);
        
        $promo->delete();

        return redirect()->back();
    }
}
