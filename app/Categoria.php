<?php

namespace laraventa;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';
    protected $primaryKey= 'idcategoria';
    public $timestamps= false; // para que no se agreguen automaticamente cuando se crean
    //ahora indicamos cuales son los atributos que recibiran un valor
    protected $fillable =[
        'nombre',
        'descripcion',
        'condicion'
    ];
    //los campos guarded se van a especificar cuando no queremos que se guarde en el modelo
    protected $guarded=[

    ];
    //
}
