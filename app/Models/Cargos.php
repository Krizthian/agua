<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos'; //Se requiere definir manualmente el nombre de la tabla
    protected $guarded = []; //Deshabilitamos la asignacion masiva
    public $timestamps= false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas
}
