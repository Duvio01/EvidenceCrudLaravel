<?php

namespace App\Http\Controllers;

use App\Models\Operadores;
use Illuminate\Http\Request;

class OperadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operadores::all();
        return view('administracionOperador', ['operators' => $operators]);
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
        $operator = new Operadores;
        $operator->nombre = $request->nameOperator;
        $operator->save();

        return redirect()->route('operadores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operadores  $operadores
     * @return \Illuminate\Http\Response
     */
    public function show(Operadores $operadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operadores  $operadores
     * @return \Illuminate\Http\Response
     */
    public function edit(Operadores $operadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operadores  $operadores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operadores $operadores,$id)
    {
        $operator = $operadores::find($id);
        $operator->nombre = $request->nameOperator;
        $operator->update();
        return redirect()->route('operadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operadores  $operadores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operadores $operadores, $id)
    {
        $operator = $operadores::find($id);
        $operator->delete();
        return redirect()->route('operadores.index');
    }
}
