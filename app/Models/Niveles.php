<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'monto_minimo_personal',
        'numero_red',
        'monto_minimo_directo',
        'monto_minimo_red',
    ];
}
