<?php

namespace App\Http\Controllers\Test;

use App\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();
        return response()->json($tests, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'nombreTest' => 'required|max:50',
            'descripcionTest' => 'required|max:255',
            'duracionTest' => 'required|digits_between:1,2',
        ];
        $test = Test::create($request->all());
        return response()->json($test, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return response()->json($test, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $rule = [
            'nombreTest' => 'required|max:50',
            'descripcionTest' => 'required|max:255',
            'duracionTest' => 'required|digits_between:1,2',
        ];
        if ($request->has('nombreTest')) {
            $test->nombreTest = $request->nombreTest;
        }
        if ($request->has('descripcionTest')) {
            $test->descripcionTest = $request->descripcionTest;
        }
        if ($request->has('duracionTest')) {
            $test->duracionTest = $request->duracionTest;
        }
        if (!$test->isDirty()) {
            return response()->json(['error' => 'Tienes que especificar un valor diferente'], 409);
        }
        $test->save();
        return response()->json($test, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return response()->json($test, 200);
    }
}
