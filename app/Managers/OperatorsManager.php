<?php

namespace App\Managers;

use App\Models\Operadores;

class OperatorsManager
{
    /**
     * @author Duvan Ramirez
     * @createdate 2023-07-18
     * Metodo que trae la data de los operadores
  */
    public function showOperators(){
        $operators = Operadores::all();
        return $operators;
    }
}
