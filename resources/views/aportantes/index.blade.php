@extends('layouts.index')

@section('content')
    <div class="row" id="row_anos">
        @foreach ($anos as $ano)
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                <div class="alert alert-success centrado hover hover-success" role="alert" onclick="mostrarMeses({{$ano}})">
                    <h4 class="alert-heading">{{$ano}}</h4>       
                </div>
            </div>           
        @endforeach       
    </div>
    <div  id="row_meses">
        <button onclick="location.reload()" class="btn btn-info margin-12 rounded-pill" id="btn_retorn_anos"><i class="material-icons">arrow_back</i>Regresar</button>
        <div class="row">       
            @foreach ($meses as $mes)
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                    <div class="alert alert-primary centrado hover hover-primary" role="alert" onclick="cargarComprobantes({{$mes['codigo']}})">
                        <h4 class="alert-heading">{{$mes['mes']}}</h4>       
                    </div>
                </div>           
            @endforeach
        </div>
    </div>
    
    
@endsection

@section('scripts')
<script>

</script>
@endsection