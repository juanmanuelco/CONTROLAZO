@extends('layouts.index')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <h2>Registro de {{$mes}} del {{$ano}}</h2>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <h5 style="padding-right:22px">Escoger archivo de excel</h5>
            <input class="border rounded shadow-sm" type="file" onchange="handleFile(event)"
                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                required="">
        </div>              
    </div>
    <div class="col-4" id="div_pasos" style="display:none">
        <h6>Pasos</h6>
        <ol type="1">
            <li>Guardar aportantes nuevos <b id="paso1"></b> </li>
            <li>Cargar todos <b id="paso2"></b> </li>
            <li>Diferenciar costos <b id="paso3"></b></li>
            <li><a href="javascript:guardarAportes()">Guardar aportes <b id="paso4"></b></a></li>
        </ol>
        <button class="btn btn-primary" onclick="cargarNuevos()">Ejecutar pasos</button>
    </div>
</div>
<div class="progress" id="barra" style="visibility:hidden; margin-top:12px">
    <div class="progress-bar progress-bar-striped progress-bar-animated" id="porcentaje" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
</div>


<hr>
<div class="row" style="padding: 20px;">
    <div class="col">
        <div class="table-responsive" id="tabla_cargada">
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection