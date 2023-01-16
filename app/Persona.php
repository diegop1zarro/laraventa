<?php

namespace laraventa;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';
    protected $primaryKey= 'idpersona';
    public $timestamps= false; // para que no se agreguen automaticamente cuando se crean
    //ahora indicamos cuales son los atributos que recibiran un valor
    protected $fillable =[
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];
    //los campos guarded se van a especificar cuando no queremos que se guarde en el modelo
    protected $guarded=[

    ];
}
