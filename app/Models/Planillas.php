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

    // Relación con Cliente
        public function cliente()
        {
            return $this->belongsTo(Clientes::class, 'id_cliente');
        }

    // Relación con Medidor
        public function medidor()
        {
            return $this->belongsTo(Medidores::class, 'id_medidor');
        }

    // Relación con Consumo
        public function consumo()
        {
            return $this->belongsTo(Consumos::class, 'id_consumo');
        }

  
}
