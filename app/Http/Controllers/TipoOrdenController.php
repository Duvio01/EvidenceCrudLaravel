<?php

namespace App\Http\Controllers;

use App\Models\TipoOrden;
use Illuminate\Http\Request;

class TipoOrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeOrders = TipoOrden::all();
        return view('administracionOrdenes', ['typeOrders' => $typeOrders]);
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
        $typeOrder = new TipoOrden;
        $typeOrder->nombre = $request->nameOrder;
        $typeOrder->save();

        return redirect()->route('tipoOrden.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoOrden  $tipoOrden
     * @return \Illuminate\Http\Response
     */
    public function show(TipoOrden $tipoOrden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoOrden  $tipoOrden
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoOrden $tipoOrden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoOrden  $tipoOrden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoOrden $tipoOrden)
    {
        $tipoOrden->nombre = $request->nameOrder;
        $tipoOrden->update();

        return redirect()->route('tipoOrden.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoOrden  $tipoOrden
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoOrden $tipoOrden)
    {
        $tipoOrden->delete();
        if($tipoOrden){
            return redirect()->route('tipoOrden.index');
        }else{
            dd('paila');
        }
    }
}
