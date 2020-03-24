<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Questions;
use App\Test;

class TestQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Test $test)
    {
        $preguntas = $test->questions;
        //dd($preguntas);
        return response()->json($preguntas, 200);
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
    public function store(Request $request, Test $test)
    {
        //dd($test);
        $pregunta = Questions::create([
            'pregunta' => $request->pregunta,
            'test_id' => $test->id,
        ]);
        return response()->json($pregunta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test, Questions $question)
    {
        return response()->json($question, 200);
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
    public function update(Request $request, Test $test, Questions $question)
    {
        //dd($question);
        if ($request->has('pregunta')){
            $question->pregunta = $request->pregunta;
        }
        if(!$question->isDirty()){
            return response()->json(['error' => 'Tienes que especificar un valor diferente'], 409);
        }
        $question->save();
        return response()->json($question, 200);
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
