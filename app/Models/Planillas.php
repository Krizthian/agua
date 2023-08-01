<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planillas extends Model
{
    use HasFactory;
    protected $table = 'planillas'; //Se requiere definir manualmente el nombre de la tabla
    public $timestamps= false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas
    protected $guarded = []; //Deshabilitamos la asignacion masiva
}
