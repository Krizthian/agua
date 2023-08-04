<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumos extends Model
{
    use HasFactory;
    protected $table = 'consumos'; //Se requiere definir manualmente el nombre de la tabla
    protected $guarded = []; //Deshabilitamos la asignacion masiva
    public $timestamps = false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas

    //Relacion con 'medidores'
        public function medidor()
        {
            return $this->belongsTo(Medidores::class, 'id_medidor'); // Cambio realizado aquí
        }

     //Relacion con 'planillas'
        public function planilla()
        {
            return $this->hasMany(Planillas::class, 'id_consumo');
        }    
}