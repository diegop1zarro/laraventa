@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
        </div>	
    </div> 
	        {!!Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
            {!!Form::token()!!}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="nombre">Nombre: </label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Colocar nombre">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="direccion">Dirección: </label>
            	<input type="text" name="nombre" value="{{old('direccion')}}" class="form-control" placeholder="Colocar dirección">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tipo_documento">Documento</label>
				<select name="tipo_documento" id="" class="form-control">
					<option value="DNI">DNI</option>
					<option value="RUC">RUC</option>
					<option value="PAS">PAS</option>
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="num_documento">Número Doc. : </label>
            	<input type="text" name="num_documento"  value="{{old('num_documento')}}" class="form-control" placeholder="Colocar Número Doc.">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="telefono">Teléfono: </label>
            	<input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="Colocar un teléfono">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="email">Email: </label>
            	<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Colocar email">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
		</div>

	</div>
           
			{!!Form::close()!!}		
@endsection