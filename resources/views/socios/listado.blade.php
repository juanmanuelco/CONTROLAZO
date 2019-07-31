@extends('layouts.index')

@section('content')
<div class="row margen">
    <div class="col-lg-12 ">
        <div class=" contenedor-bordes">
            @include('includes.central_mensajes')
            <h3 class="centrado calibri ">Modificación y eliminación</h3>
            <div class="navbar-form">
                <input type="search" name="parametro" id="Buscador" class="calibri"
                    placeholder="Buscar..." onkeyup="buscador(this.value,'tabla_locales' )">
                <button type="" class="btn btn-warning nwarning calibri">Buscar</button>
                <button type="" class="btn btn-success calibri" onclick="$('#modal_anadir_aportante').modal()">Añadir nuevo</button>
            </div><br>
            <div class="table-responsive" style="max-height:700px;">
                <table class="table calibri table-bordered" id="tabla_locales">
                    <thead class="thead-dark">
                        <tr class="centrado">
                            <th scope="col" >#</th>
                            <th scope="col" >Acciones</th>
                            <th scope="col" >Cédula</th>
                            <th scope="col" >Nombre</th>
                            <th scope="col" >Proceso</th>
                            <th scope="col" >Tipo</th>
                            <th scope="col" >Sueldo</th>
                        </tr>
                    </thead>
                    <div style="display:none">{{ $count = 1 }}</div>
                    <tbody class="">
                        @foreach ($socios as $socio)
                        <tr class="fila_v">
                            <td class="align-middle conteo">{{ $count++ }}</td> 
                            <td class="align-middle"> 
                                <button 
                                    class="btn btn-primary" 
                                    onclick="cargarModal(
                                        'modal_editar_aportante', 
                                        '{{route('detalle_aportante', ['codigo'=>$socio->id])}}', 
                                        'form_actualizar_aportante', 'aportante' 
                                    )">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button 
                                    class="btn btn-danger" 
                                    onclick="eliminarReg(
                                        '{{$socio->id}}', 
                                        '{{route('eliminar_aportante')}}',
                                        'local'
                                    )">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </td>
                            <td>{{$socio->cedula}}</td>
                            <td>{{$socio->nombre}}</td>
                            <td>{{$socio->proceso}}</td>
                            <td>
                                <select name="" id="sel_soc_apor" onchange="cambiarTipo({{$socio->id}})">
                                    @if ($socio->tipo == 'SOCIO')
                                        <option value="SOCIO" id="op_soc_{{$socio->id}}">SOCIO</option>
                                        <option value="APORTANTE" id="op_apo_{{$socio->id}}">APORTANTE</option>                             
                                    @else
                                        <option value="APORTANTE" id="op_apo_{{$socio->id}}" >APORTANTE</option>
                                        <option value="SOCIO" id="op_soc_{{$socio->id}}" >SOCIO</option>
                                    @endif
                                    
                                </select>
                            </td>
                            @if ($socio->sueldo == 0)
                                <td style="background-color:red; color:white">${{$socio->sueldo}}</td>
                            @else
                                <td>${{$socio->sueldo}}</td>
                            @endif                               
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('modales.modal_editar_aportante')
@include('modales.modal_anadir_aportante')
@endsection

@section('scripts')
<script>

</script>
@endsection