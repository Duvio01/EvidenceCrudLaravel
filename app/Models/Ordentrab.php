<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordentrab extends Model
{
    protected $table = 'ordentrab';
    protected $fillable = [
        'fecha_creacion',
        'fecha_asigancion',
        'fecha_ejecucion',
        'id_tipo',
        'id_operador',
        'descripcion',
        'valor'
    ];
    use HasFactory;

}
