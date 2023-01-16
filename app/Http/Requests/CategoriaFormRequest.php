<?php

namespace laraventa\Http\Requests;

use laraventa\Http\Requests\Request;

class CategoriaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //realizamos las reglas
        return [
            //le colocamos el nombre de como saldrá en nuestro form
            'nombre'=>'required|max:50',
            'descripcion'=>'max:256'
            //
        ];
    }
}
