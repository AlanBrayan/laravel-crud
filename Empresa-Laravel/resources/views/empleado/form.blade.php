<!--Validar form-->
@if(count($errors)>0)
<div class="alert alert-primary" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif
<!--Validar form-->



<!--Form-->
<div class="form-group" style="width: 80%; margin-left: 10%;">
    <label>Nombre:</label>
    <input type="text" name="nombre" id="nombre" class="form-control"
        value="{{ isset($empleado->nombre)?$empleado->nombre:'' }}">
    <br>
    <label>Apellido paterno:</label>
    <input type="text" name="app" id="app" class="form-control" value="{{ isset($empleado->app)?$empleado->app:'' }}">
    <br>
    <label>Apellido materno:</label>
    <input type="text" name="apm" id="apm" class="form-control" value="{{ isset($empleado->apm)?$empleado->apm:'' }}">
    <br>
    <label>Correo:</label>
    <input type="text" name="correo" id="correo" class="form-control"
        value="{{ isset($empleado->correo)?$empleado->correo:'' }}">
    <br>
    <label>Foto: &nbsp;&nbsp;
        @if(isset($empleado->foto))
        <img src="{{ asset('storage').'/'. $empleado->foto }}" width="100px" height="100px">
        @endif
    </label>
    <br><br>
    <input type="file" name="foto" id="foto" class="form-control" accept=".png">
    <br>
    <button type="submit" class="btn btn-primary">{{ $modo }} datos</button>
</div>
<!--Form-->