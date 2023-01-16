<?php

namespace laraventa\Http\Controllers;

use Illuminate\Http\Request;

use laraventa\Http\Requests;
use laraventa\Http\Controllers\Controller;

use laraventa\Persona;
use illuminate\Support\Facades\Redirect;
use laraventa\http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
{
    public function _construct(){
     //lo tuilizaremos para validar
    }
 
 
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index( Request $request)
     {
         if($request){
             $query=trim($request->get('searchText'));
             $personas= DB::table('persona')
             ->where('nombre','LIKE','%'.$query.'%')
             ->where('tipo_persona','=','Cliente')
             ->orwhere('num_documento','LIKE','%'.$query.'%')
             ->where('tipo_persona','=','Cliente')
             ->orderBy('idpersona','desc')
             ->paginate(7);
             return view('ventas.cliente.index', ['personas'=>$personas,'searchText'=>$query]); 
         }
         //
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('ventas.cliente.create');
         //
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(PersonaFormRequest $request)
     //el store almacena el objeto del modelo categoria en nuestra tabla categoria de nuestra base de datos
     {
         $persona = new Persona;
         $persona->tipo_persona='Cliente';
         $persona->nombre= $request->get('nombre');
         $persona->tipo_documento= $request->get('tipo_documento');
         $persona->num_documento= $request->get('num_documento');
         $persona->direccion= $request->get('direccion');
         $persona->telefono= $request->get('telefono');
         $persona->email= $request->get('email');
         $persona->save();
         return \Redirect::to('ventas/cliente');
         //
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         return view('ventas.cliente.show',['persona'=>Persona::findOrFail($id)]);
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         return view('ventas.cliente.edit',['persona'=>Persona::findOrFail($id)]);
 
         //
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(PersonaFormRequest $request, $id)
     {
        $persona =Persona::findOrFail($id);
        $persona->nombre= $request->get('nombre');
        $persona->tipo_documento= $request->get('tipo_documento');
        $persona->num_documento= $request->get('num_documento');
        $persona->direccion= $request->get('direccion');
        $persona->telefono= $request->get('telefono');
        $persona->email= $request->get('email');
        $persona->update();
        return \Redirect::to('ventas/cliente');
        //
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $persona=Persona::findOrFail($id);
         $persona->tipo_persona='Inactivo';
         $persona->update();
         return \Redirect::to('ventas/cliente');
         //
     }
 }
 