@extends('layouts.index')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <h2>Registro de {{$mes}} del {{$ano}}</h2>
    </div>
</div>
<div class="progress" id="barra" style="visibility:hidden; margin-top:12px">
    <div class="progress-bar progress-bar-striped progress-bar-animated" id="porcentaje" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
</div>
<hr>
<div class="row" style="padding: 20px;">
    <div class="col">
        <div class="table-responsive" id="tabla_cargada">
            <p style="display:none">{{$count =1}}</p>
            <div style="padding-bottom:12px">
                <button class="btn btn-primary" onclick="seleccionTodos()">Seleccionar todos</button>
                <button class="btn btn-primary" onclick="descargarExcels()">Obtener seguimiento de seleccionados</button>
            </div>
            <div class="progress" id="barra" style="visibility:hidden; margin-top:12px">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="porcentaje" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
            <table class="table table-bordered">
                <tr style="background-color:#ff9924">
                    <td></td><td>A</td><td>B</td><td>C</td><td>D</td><td>E</td><td>F</td><td>G</td><td>F</td>
                </tr>
                @foreach ($mensuales as $mensual)
                    @if ($mensual->ahorro >0)
                        <tr class="fondo-socio">
                    @else
                        <tr class="fondo-aportante">
                    @endif
                        <td style="background-color:#ff9924">{{$count++}}</td>
                        <td><input type="checkbox" name="filas_aportantes" id="check_{{$mensual->cedula}}" class="check_fila"></td>
                        <td>{{$mensual->nombre}}</td>
                        <td>{{$mensual->proceso}}</td>
                        <td>{{$mensual->cedula}}</td>
                        <td class="td_valor" style="text-align:right">{{$mensual->valor}}</td>
                        <td class="td_aporte" style="text-align:right">{{$mensual->aporte}}</td>
                        <td class="td_ahorro" style="text-align:right">{{$mensual->ahorro}}</td>
                        <td>{{$mensual->estado}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="4" style="text-align:right"><b>Totales</b></td>
                    <td id="td_tot_val" style="text-align:right"></td>
                    <td id="td_tot_apo" style="text-align:right"></td>
                    <td id="td_tot_aho" style="text-align:right"></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="tablas_ocultas" style="display:none" >

</div>
<div id="opciones_ocultas"></div>
<script>
    window.addEventListener('load', ()=>{
        valores = document.getElementsByClassName('td_valor')
        aportes = document.getElementsByClassName('td_aporte')
        ahorros = document.getElementsByClassName('td_ahorro')
        suma_val=0, suma_apo=0, suma_aho=0
        for(var i = 0; i < valores.length; i++){
            suma_val+= Number(valores[i].innerHTML);
            suma_apo+= Number(aportes[i].innerHTML);
            suma_aho+= Number(ahorros[i].innerHTML);
        }
        td_tot_val.innerHTML = '$' + suma_val.toFixed(2)
        td_tot_apo.innerHTML = '$' + suma_apo.toFixed(2)
        td_tot_aho.innerHTML = '$' + suma_aho.toFixed(2)
    })
</script>
@endsection

@section('scripts')
<script>

</script>
@endsection