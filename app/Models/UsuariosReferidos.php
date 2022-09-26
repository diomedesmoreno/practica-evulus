<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosReferidos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'usuario_referido_id',
        'usuario_referidor_id'
    ];

    public function usuarios(){
        return $this->belongsTo(User::class,'id','id');
    }
}
