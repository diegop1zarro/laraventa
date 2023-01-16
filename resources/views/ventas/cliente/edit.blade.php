@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente {{$persona->nombre}}</h3>
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
	{!!Form::model($persona,['method'=>'PATCH','route'=>['ventas.cliente.update',$persona->idpersona]])!!}
            {!!Form::token()!!}
			<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="nombre">Nombre: </label>
            	<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="direccion">Dirección: </label>
            	<input type="text" name="nombre" value="{{$persona->direccion}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="tipo_documento">Documento</label>
				<select name="tipo_documento" id="" class="form-control">
					@if ($persona->tipo_documento=='DNI')
					<option value="DNI" selected>DNI</option>
					<option value="RUC">RUC</option>
					<option value="RUC">PAS</option>
					@elseif ($persona->tipo_documento=='RUC')
					<option value="DNI">DNI</option>
					<option value="RUC" selected>RUC</option>
					<option value="RUC">PAS</option>
					@else
					<option value="DNI">DNI</option>
					<option value="RUC">RUC</option>
					<option value="RUC" selected>PAS</option>
					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="num_documento">Número Doc. : </label>
            	<input type="text" name="num_documento"  value="{{$persona->num_documento}}" class="form-control">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="telefono">Teléfono: </label>
            	<input type="text" name="telefono" required value="{{$persona->telefono}}" class="form-control" placeholder="Colocar un teléfono">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		    <div class="form-group">
            	<label for="email">Email: </label>
            	<input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="Colocar email">
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