<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes'; //Se requiere definir manualmente el nombre de la tabla
    protected $guarded = []; //Deshabilitamos la asignacion masiva
    public $timestamps= false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas

    //Relacion con 'medidor'
        public function medidor()
            {
                return $this->hasOne(Medidores::class, 'id_cliente');
            }

    // Relación con Planilla
        public function planilla()
            {
                return $this->hasMany(Planillas::class, 'id_cliente');
            }    
}
