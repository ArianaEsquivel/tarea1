<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->tokenCan('user:info')) {
            return response()->json(["perfil"=>$request->user()], 200);
        }
        return abort(401, "Scope inválido");
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
        $users = User::create($request->all());
        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id', $id)->first();
        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $affected = DB::table('users')
              ->where('id', $id)
              ->update(['name' => $request->name, 'age' => $request->age, 
                        'sign' => $request->sign,
                        'email' => $request->email,
                        'password' => $request->password]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
    }

    public function logIn(Request $request )
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Usuario o contraseña incorrecta...'],
            ]);
        }

        $token = $user->createToken($request->email, ['user:info'])->plainTextToken;
        return response()->json(["token" => $token], 201);
        
    }

    public function logOut(Request $request )
    {
        return response()->json(["afectados" => $request->user()->tokens()->delete()], 200);   
    }

    public function registro(Request $request )
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user              = new User();
        $user->name        = $request->name;
        $user->age        = $request->age;
        $user->sign        = $request->sign;
        $user->email       = $request->email;
        $user->password    = Hash::make($request->password);
        if ($user->save())
            return response()->json($user, 201);
        
        return abort(400, "Error al registrar usuario");
        
    }
    public function cuenta(Request $request )
    {
        return $request->user();
    }


}
