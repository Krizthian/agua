<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidores extends Model
{
    use HasFactory;
    protected $table = 'medidores'; //Se requiere definir manualmente el nombre de la tabla
}