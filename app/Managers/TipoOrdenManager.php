<?php

namespace App\Managers;

use App\Models\TipoOrden;

class TipoOrdenManager
{
    public function showTypeOrders() {
        $typeOrders = TipoOrden::all();
        return $typeOrders;
    }
}
