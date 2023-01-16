<?php

namespace laraventa\Http\Controllers;

use Illuminate\Http\Request;

use laraventa\Http\Requests;
use laraventa\Http\Controllers\Controller;

//agregamos el modelo
use laraventa\Categoria;
use illuminate\Support\Facades\Redirect; //para hacer redirecciones
use laraventa\http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
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
            $categorias= DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            //como vemos podemos agregar mas de un where o condiciones
            return view('almacen.categoria.index', ['categorias'=>$categorias,'searchText'=>$query]);
            // esto lo devolveremos a la vista almace.categoria.index y con dos parametros que serian las categorias y el search


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
        return view('almacen.categoria.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaFormRequest $request)
    //el store almacena el objeto del modelo categoria en nuestra tabla categoria de nuestra base de datos
    {
        $categoria = new Categoria;
        $categoria->nombre= $request->get('nombre');
        $categoria->descripcion= $request->get('descripcion');
        $categoria->condicion= '1'; //haciendo referencia a que en un principio la cetegoria está activa, si no está activa es 0
        $categoria->save();
        return \Redirect::to('almacen/categoria');
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
        return view('almacen.categoria.show',['categoria'=>Categoria::findOrFail($id)]);
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
        return view('almacen.categoria.edit',['categoria'=>Categoria::findOrFail($id)]);

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaFormRequest $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return \Redirect::to('almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return \Redirect::to('almacen/categoria');
        //
    }
}
