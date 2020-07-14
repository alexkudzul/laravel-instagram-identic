<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // $user = Auth::user();

        return view('users.edit');
        // return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Nota: no se utiliza lo tradicional para actualizar datos, en este caso se utiliza
    //  las validaciones para recoger los datos que llegan en la $request
    public function update(Request $request, User $user)
    {
        // Reglas de validación
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        // Validar password => filled(lleno), esta lleno el campo password?
        // bcryp se aplica en model con un mutador
        if ($request->filled('password')) {

            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];

        }

        // Validar imagen
        if($request->hasFile('avatar')){

            $this->validate($request, ['avatar' => 'image'],['avatar.image' => 'Foto de perfil debe ser una imagen']);
            // $request->validate(['avatar' => 'image'],['avatar.image' => 'Foto de perfil debe ser una imagen']);

            $user->avatar = $request->file('avatar')->store('avatars','public');// store->indica en que carpeta sera guardado
        }

        // Devuelve los datos validados
        $dataUser = $request->validate($rules);

        // Actualiza los datos validados
        $user->update($dataUser);

        return redirect()->route('users.edit')->with('flash', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
