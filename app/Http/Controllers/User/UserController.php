<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'noControlUser'  => 'required|unique:users|digits:8',
            'email' => 'email|required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'nombreUser' => 'required|max:50',
            'apellidoUser' => 'required|max:50',
            'especialidadUser' => 'required|max:50',
            'semestreUser' => 'required|digits_between:1,2',
            'edadUser' => 'required|digits_between:1,2',
        ];
        //$this->validate($request, $rules);
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nombreUser' => 'required|max:50',
            'apellidoUser' => 'required|max:50',
            'especialidadUser' => 'required|max:50',
            'semestreUser' => 'required|digits_between:1,2',
            'edadUser' => 'required|digits_between:1,2',
        ];
        // $this->validate($request, $rules);
        if ($request->has('nombreUser')) {
            $user->nombreUser = $request->nombreUser;
        }
        if ($request->has('apellidoUser')) {
            $user->apellidoUser = $request->apellidoeUser;
        }
        if ($request->has('especialidadUser')) {
            $user->especialidadUser = $request->especialidadUser;
        }
        if ($request->has('semestreUser')) {
            $user->semestreUser = $request->semestreUser;
        }
        if ($request->has('edadUser')) {
            $user->edadUser = $request->edadUser;
        }
        if (!$user->isDirty()) {
            return response()->json(['error' => 'Tienes que especificar un valor diferente'], 409);
        }

        $user->save();
        return response()->json($user, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user, 200);
    }
}
