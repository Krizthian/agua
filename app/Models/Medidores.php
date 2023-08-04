<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidores extends Model
{
    use HasFactory;
    protected $table = 'medidores'; //Se requiere definir manualmente el nombre de la tabla
    protected $guarded = []; //Deshabilitamos la asignacion masiva
    public $timestamps = false; //Deshabilitamos los timestamps puesto que esta tabla no los tiene como columnas

    public function consumo()
    {
        return $this->hasOne(Consumos::class, 'id_medidor');
    }

     public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
}
