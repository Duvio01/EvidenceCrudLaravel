<?php

namespace App\Managers;

use App\Models\TipoOrden;

class TipoOrdenManager
{
    /**
     * @author Duvan Ramirez
     * @createdate 2023-07-18
     * Metodo que trae la data de las ordenes
  */
    public function showTypeOrders() {
        $typeOrders = TipoOrden::all();
        return $typeOrders;
    }
}
