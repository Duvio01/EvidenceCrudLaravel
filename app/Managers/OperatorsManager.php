<?php

namespace App\Managers;

use App\Models\Operadores;

class OperatorsManager
{
    public function showOperators(){
        $operators = Operadores::all();
        return $operators;
    }
}
