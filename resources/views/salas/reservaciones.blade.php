@extends('layouts.index')

@section('content')

<div class="container">
    @include('includes.central_mensajes')
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h4 class="centrado">Registro de reservaciones</h4>
            <hr>
            <form action="{{route('guardar_reserva')}}" id="form_save_reser" method="post" style="padding-bottom:32px" onsubmit="revisarReserva(event)">
                <div style="display:none">
                    {{date_default_timezone_set('America/Guayaquil')}}
                </div>
                {{ csrf_field() }} 
                <div class="form-group">
                    <label for="">Fecha y hora de inicio de reservación</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-6">
                            <input type="time" name="hora_ini" id="hora_ini" class="form-control" value="{{date('H:i')}}">
                        </div>
                    </div>                                      
                </div>
                <div class="form-group">
                    <label for="">Fecha y hora de fin de reservación</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="fecha_fin"  name="fecha_fin">
                        </div>
                        <div class="col-6">
                            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{date('H:i')}}">
                        </div>
                    </div>                                      
                </div>
                <div class="form-group">
                    <label for="">Sala a reservar</label>
                    <select name="sala" id="" class="form-control">
                        @foreach ($salas as $sala)
                            <option value="{{$sala->id}}">{{$sala->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre de quien reserva</label>
                    <input type="text" name="nombre" class="form-control" id="">
                </div>

                <div class="form-group">
                    <label for="">Cédula de quien reserva</label>
                    <input type="text" name="cedula" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label for="">¿Pagado?</label>
                    <label class="switch">
                        <input type="checkbox" name="pagado">
                        <span class="slider round"></span>
                    </label>
                </div>  
                <button type="submit" class="btn btn-primary">Generar reservación</button>
                      
            </form>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h4 class="centrado">Modificación y cancelación</h4>
            <hr>
            <div class="navbar-form" style="text-align:right">
                <input type="search" name="parametro" id="Buscador" class="calibri"
                    placeholder="Buscar..." onkeyup="buscador(this.value,'tabla_locales' )">
                <button type="" class="btn btn-warning nwarning calibri">Buscar</button>
            </div><br>
            <div class="table-responsive" style="max-height:700px;">
                <table class="table calibri table-bordered" id="tabla_locales">
                    <thead class="thead-dark">
                        <tr class="centrado">
                            <th scope="col"  style="width:5%">#</th>
                            <th scope="col" style="width:15%"> Acciones</th>
                            <th scope="col"  style="width:20%">Nombre</th>
                            <th scope="col"  style="width:30%">Descripción</th>
                            <th scope="col"  style="width:15%">Capacidad</th>
                            <th scope="col"  style="width:15%">Precio</th>
                        </tr>
                    </thead>
                    <div style="display:none">{{ $count = 1 }}</div>
                    <tbody class="">
                        
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
</div>
@include('modales.modal_editar_sala')
    
@endsection

@section('scripts')
<script>

</script>

<style>
    .form-control{
        border:1px solid #c8c7c7;
        background-color:  #f0ecec;
    }
</style>
@endsection