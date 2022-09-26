<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
// class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->addAppends(["usuario_directo","usuario_red_total"]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nivel_id',
		'mi_codigo_referido',
		'codigo_referido_de',
		'monto_actual'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function niveles(){
        return $this->hasOne(Niveles::class,'id','nivel_id');
    }

    public function referidos(){
        return $this->hasMany(UsuariosReferidos::class,'usuario_referidor_id','id');
    }

    public function montoReferidosDirectos(){
        $valores = $this->hasMany(UsuariosReferidos::class,'usuario_referidor_id','id')->get();

        $ids = array();

        foreach($valores as $key => $item){
            array_push($ids,$item->usuario_referido_id);
        }

        return $this->whereIn('id',$ids)->sum('monto_actual');
    }

    public function getUsuarioDirectoAttribute(){
        $cantidad = $this->hasMany(UsuariosReferidos::class,'usuario_referidor_id','id')->count();

        $monto = $this->montoReferidosDirectos();

        return array([
            'miembro_red' => $cantidad,
            'monto_total_red' => (float) $monto,
        ]);
    }

    public function getusuarioNivelAttribute(){
        return $this->hasMany(UsuariosReferidos::class,'usuario_referidor_id','id')->count();
    }

    public function getUsuarioRedTotalAttribute(){

        $u_id = $this->id;

        $elemtentos_red = \DB::table('usuarios_referidos')
        ->where('id_rastro','like','%'.$u_id.',%')
        ->where('usuario_referidor_id','!=',$u_id)
        ->count();

        $valores_elemtentos_red = \DB::table('usuarios_referidos')->select('usuario_referido_id','id_rastro')
        ->where('id_rastro','like','%'.$u_id.',%')
        ->where('usuario_referidor_id','!=',$u_id)
        ->get();

        $uno = array();
        $maximo = 0;
        $nivel_maximo = 0;
        foreach ($valores_elemtentos_red as $key => $value) {
            array_push($uno,$value->usuario_referido_id);
            if (strlen($value->id_rastro) > $maximo){
                $maximo = strlen($value->id_rastro);
                $nivel_maximo = $value->id_rastro;
            }
        }

        $explode = explode(',',$nivel_maximo);
        $explode = count($explode) - 1;

        $monto_elemtentos_red = \DB::table('users')
        ->whereIn('id',$uno)
        ->sum('monto_actual');

        $nivel = \DB::table('niveles')->max('numero_red');

        $nivel_red = \DB::table('niveles')->where('numero_red','>=',$explode)->first();

        // 
        // dd($explode);
        // if ($explode > $nivel){
        //     \DB::table('niveles')->insert(
        //         ['nombre' => 'nivel '.$explode, 'numero_red' => $explode,'monto_minimo_personal'=>1]
        //     );
        // }
        
        $id = $nivel_red->id;

        if (($this->monto_actual > $nivel_red->monto_minimo_personal) && ($this->montoReferidosDirectos() > $nivel_red->monto_minimo_directo) && ($monto_elemtentos_red > $nivel_red->monto_minimo_red) ) {
            $nivel_red = $nivel_red->numero_red;
            \DB::table('users')->where('id',$u_id)->update(['nivel_id' => $id]);
        } else {
            $nivel_red =  'Sin nivel';
        }

        return array([
            'elementos_red' => $elemtentos_red,
            'monto_elementos_red' => $monto_elemtentos_red,
            'nivel_red' => $nivel_red,
        ]);
    }
}
