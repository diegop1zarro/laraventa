<?php

namespace laraventa;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';
    protected $primaryKey= 'idarticulo';
    public $timestamps= false; // para que no se agreguen automaticamente cuando se crean
    //ahora indicamos cuales son los atributos que recibiran un valor
    protected $fillable =[
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];
    //los campos guarded se van a especificar cuando no queremos que se guarde en el modelo
    protected $guarded=[

    ];
}
