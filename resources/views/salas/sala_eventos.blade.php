@extends('layouts.index')

@section('content')

<div class="container">
    @include('includes.central_mensajes')
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h4 class="centrado">Registro de salas de eventos</h4>
            <hr>
            <form action="{{route('anadir_sala')}}" method="post" style="padding-bottom:32px">
                {{ csrf_field() }} 
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea name="descripcion" id="" class="form-control" cols="30" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Capacidad de personas</label>
                    <input type="number" name="capacidad" class="form-control" min="1" step="1" value="0" required id="">
                </div>
                <div class="form-group">
                    <label for="">Precio por hora $</label>
                    <input type="number" name="precio" class="form-control" min="1" step="0.01" value="0" required id="">
                </div>
                <button type="submit" class="btn btn-primary">Registrar sala</button>
            </form>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h4 class="centrado">Modificación y eliminación</h4>
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
                        @foreach ($salas as $sala)
                            <tr class="fila_v">
                                <td class="align-middle conteo">{{ $count++ }}</td> 
                                <td class="align-middle"> 
                                    <button 
                                        class="btn btn-primary" 
                                        onclick="cargarModal(
                                            'modal_editar_sala', 
                                            '{{route('detalle_sala', ['codigo'=>$sala->id])}}', 
                                            'form_actualizar_sala', 'sala' 
                                        )">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    <button 
                                        class="btn btn-danger" 
                                        onclick="eliminarReg(
                                            '{{$sala->id}}', 
                                            '{{route('eliminar_sala')}}',
                                            'sala'
                                        )">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </td>
                                <td>{{$sala->nombre}}</td>
                                <td>{{$sala->descripcion}}</td>
                                <td>Máx. {{$sala->capacidad}} personas</td>
                                <td>${{$sala->precio}} x hora</td>
                            </tr>
                        @endforeach
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