<?php

namespace App\Http\Controllers;

use App\Managers\OperatorsManager;
use App\Managers\TipoOrdenManager;
use App\Models\Ordentrab;
use Illuminate\Http\Request;

class OrdentrabController extends Controller
{
    public function __construct()
    {
        $this->operatorsManager = new OperatorsManager;
        $this->typeOrders = new TipoOrdenManager;
    }

    function indexOrder(Request $request)
    {
        $orders = Ordentrab::select('ordentrab.id','ordentrab.fecha_creacion','ordentrab.fecha_asignacion', 'ordentrab.fecha_ejecucion', 't.nombre as tipo_orden', 'op.nombre as operador', 'ordentrab.descripcion','ordentrab.valor')
        ->join('tipo_orden as t', 't.id', '=', 'ordentrab.id_tipo')
        ->leftjoin('operadores as op', 'op.id', '=', 'ordentrab.id_operador')
        ->when(!is_null($request->searchOperador), function($q) use ($request) {
            return $q->where('id_operador', $request->searchOperador);
        })
        ->when( !is_null($request->searchOrder), function($q) use ($request) {
            return $q->where('id_tipo', $request->searchOrder);
        })
        ->when( !is_null($request->searchFechaAsignacion), function($q) use ($request) {
            return $q->where('fecha_asignacion', $request->searchFechaAsignacion);
        })
        ->get();


        return view('welcome', ['operators' => $this->operatorsManager->showOperators(), 'typeOrders' => $this->typeOrders->showTypeOrders(), 'orders' => $orders]);
    }

    function saveOrder(Request $request)
    {
        $ordenTrab = new Ordentrab;
        $ordenTrab->id_tipo = $request->order;
        $ordenTrab->fecha_creacion = now();
        $ordenTrab->save();

        return redirect()->route('index');
    }

    function saveAssign(Request $request) {

        $ordenTrab = Ordentrab::find($request->id);
        $ordenTrab->fecha_asignacion = $request->fechaAsignacion;
        $ordenTrab->id_operador = $request->operador;
        $ordenTrab->update();

        return redirect()->route('index');
    }

    function saveResult(Request $request){
        $ordenTrab = Ordentrab::find($request->id);
        $ordenTrab->id_operador = $request->operador;
        $ordenTrab->fecha_ejecucion = $request->fechaEjecutada;
        $ordenTrab->descripcion = $request->resultado;
        $ordenTrab->valor = $request->valor;
        $ordenTrab->update();

        return redirect()->route('index');
    }
}
