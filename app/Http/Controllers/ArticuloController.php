<?php

namespace laraventa\Http\Controllers;

use Illuminate\Http\Request;

use laraventa\Http\Requests;
use laraventa\Http\Controllers\Controller;

use illuminate\Support\Facades\Redirect; //para hacer redirecciones
use illuminate\Support\Facades\Input;  //lo usaremos para poder subir la imagen de la maquina del cliente a nuestro servidor
use laraventa\http\Requests\ArticuloFormRequest;
use laraventa\Articulo;
use DB;



class ArticuloController extends Controller
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
             //trim le quita los espacios en blancos del principio y final
 
             // '%' le especificamos que no importa si el texto se encuentra al principio o final de la cadena.
             $articulos= DB::table('articulo as a')
             // la tabla articulo esta relacionada con la tabla categoria por ello hacemos un join
             // diremos que la tabla a tendrá un idcategoria que sera el mismo que está en la tabla c
             ->join('categoria as c', 'a.idcategoria','=','c.idcategoria')
             ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
             ->where('a.nombre','LIKE','%'.$query.'%')
             ->orwhere('a.codigo','LIKE','%'.$query.'%')
             ->orderBy('a.idarticulo','desc')
             ->paginate(7);
             //como vemos podemos agregar mas de un where o condiciones
             return view('almacen.articulo.index', ['articulos'=>$articulos,'searchText'=>$query]);
             // esto lo devolveremos a la vista almace.articulo.index y con dos parametros que serian los articulos y el search
 
 
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
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
         return view('almacen.articulo.create',['categoria'=>$categorias]);
         //
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(ArticuloFormRequest $request)
     //el store almacena el objeto del modelo articulo en nuestra tabla articulo de nuestra base de datos
     {
         $articulo = new Articulo;
         $articulo->idcategoria= $request->get('idcategoria');
         $articulo->codigo= $request->get('codigo');
         $articulo->nombre= $request->get('nombre');
         $articulo->stock= $request->get('stock');
         $articulo->descripcion= $request->get('descripcion');
         $articulo->estado= 'Activo'; //haciendo referencia a que en un principio el articulo está activo
         if(Input::hasFile('imagen')){
            $file= Input::file('imagen');
            //moveremos la imagen que nos da el cliente a esta ruta
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        $articulo->imagen=$file->getClientOriginalName();
         }
         $articulo->save();
         return \Redirect::to('almacen/articulo');
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
         return view('almacen.articulo.show',['articulo'=>Articulo::findOrFail($id)]);
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
        $articulo = Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
         return view('almacen.articulo.edit',['articulo'=>$articulo,'categorias'=>$categorias]);
 
         //
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(ArticuloFormRequest $request, $id)
     {
         $articulo=Articulo::findOrFail($id);
         $articulo->idcategoria= $request->get('idcategoria');
         $articulo->codigo= $request->get('codigo');
         $articulo->nombre= $request->get('nombre');
         $articulo->stock= $request->get('stock');
         $articulo->descripcion= $request->get('descripcion');
        //  $articulo->estado= 'Activo'; 
         if(Input::hasFile('imagen')){
            $file= Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        $articulo->imagen=$file->getClientOriginalName();
         }
         $articulo->update();
         return \Redirect::to('almacen/articulo');
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $articulo=Articulo::findOrFail($id);
         $articulo->estado='Inactivo';
         $articulo->update();
         return \Redirect::to('almacen/articulo');
         //
     }
 }
 