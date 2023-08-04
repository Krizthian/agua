<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos'; //Se requiere definir manualmente el nombre de la tabla
    protected $guarded = []; //Deshabilitamos la asignacion masiva
    public $timestamps = false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas

    // Relación con Cliente
        public function cliente()
        {
            return $this->belongsTo(Clientes::class, 'id_cliente');
        }

    // Relación con Planilla
        public function planilla()
        {
            return $this->belongsTo(Planillas::class, 'id_planilla');
        }



}
