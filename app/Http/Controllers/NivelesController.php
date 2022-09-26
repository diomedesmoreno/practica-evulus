<?php

namespace App\Http\Controllers;

use App\Models\Niveles;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;
use Validator;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = Niveles::orderBy('id', 'DESC')->get();

        return $this->ok("Detalles de Nivel",["niveles"=>$niveles]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =\Validator::make($request->all(),[
            'nombre' => 'required',
            'monto_minimo_personal' => 'required',
            'monto_minimo_directo' => 'required',
            'monto_minimo_red' => 'required',
            'numero_red' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error de validacion.', $validator->errors());       
        }
    
        $nivel = Niveles::create($request->all());
     
        return $this->ok("Detalles de Nivel",["nivel"=>$nivel]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function show(Niveles $niveles,$id)
    {
        $nivel = Niveles::find($id);

        if (is_null($nivel)) {
            return $this->sendError('Nivel no encontrado.');
        }

        return $this->ok("Detalles de Nivel",["nivel"=>$nivel]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveles $niveles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveles $niveles,$id)
    {
        $validator =\Validator::make($request->all(),[
            'nombre' => 'required',
            'monto_minimo_personal' => 'required',
            'numero_red' => 'required',
            'monto_minimo_red' => 'required',
            'numero_red' => 'required',
        ]);

        if($validator->fails()){
            // dd($validator->errors());
            return $this->sendError('Error de validacion.', $validator->errors());       
        }

        $nivel = Niveles::find($id);
        $nivel->nombre = $request->nombre;
        $nivel->monto_minimo_personal = $request->monto_minimo_personal;
        $nivel->monto_minimo_directo = $request->monto_minimo_directo;
        $nivel->monto_minimo_red = $request->monto_minimo_red;
        $nivel->numero_red = $request->numero_red;

        $nivel->save();

        return $this->ok("Detalles de Nivel",["nivel"=>$nivel]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveles $niveles)
    {
        //
    }
}
