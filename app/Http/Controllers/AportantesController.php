<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class AportantesController extends Controller
{
    const meses = [
        ['codigo' => 1, 'mes'=> 'Enero'],       ['codigo' => 2, 'mes'=> 'Febrero'],     ['codigo' => 3, 'mes'=> 'Marzo'],
        ['codigo' => 4, 'mes'=> 'Abril'],       ['codigo' => 5, 'mes'=> 'Mayo'],        ['codigo' => 6, 'mes'=> 'Junio'],
        ['codigo' => 7, 'mes'=> 'Julio'],       ['codigo' => 8, 'mes'=> 'Agosto'],      ['codigo' => 9, 'mes'=> 'Septiembre'],
        ['codigo' => 10, 'mes'=> 'Octubre'],    ['codigo' => 11, 'mes'=> 'Noviembre'],  ['codigo' => 12, 'mes'=> 'Diciembre']
    ];

    public function index(){
        $ano = date("Y"); $anos = array_reverse(range(2000, $ano)); 
        return view('aportantes.index', ['anos'=>$anos, 'meses' => self::meses]);
    }

    public function reportes_viejos($ano, $mes){
        $key = array_search($mes, array_column(self::meses, 'codigo'));
        $ano_actual = date("Y");
        $continua = false;
        if(is_numeric($ano) && $ano <= $ano_actual &&  $ano>= 2000) $continua = true;                     
        if($key != false && $continua){
            $mes_detalle = self::meses[$key];
            $regitro = DB::table('tabla_mes_aportacion')->where('anual', $ano)->where('mensual', $mes)->get()->first();
            $abecedario = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","U","V","W","X","Y","Z"];
            if($regitro != null){

                $mensuales = DB::table('tabla_mes_aportacion')
                ->where('anual', $ano)
                ->where('mensual', $mes)
                ->join('tabla_aportantes', 'tabla_mes_aportacion.aportante', '=', 'tabla_aportantes.id')
                ->orderBy('nombre')
                ->get();

                return view('aportantes.ver_aportantes', ['mes' => $mes_detalle['mes'], 'ano'=>$ano, 'abecedario' => $abecedario, 'mensuales' => $mensuales]);
            }else return view('aportantes.cargar_aportantes', ['mes' => $mes_detalle['mes'], 'ano'=>$ano, 'abecedario' => $abecedario]);       
        }else  return 'No permitido';  
    }

    public function todos_aportantes(Request $datos){
        $elementos = $datos->elementos;
        foreach ($elementos as $elemento) {
           $aportante = DB::table('tabla_aportantes')->where('cedula' , $elemento['cedula'])->first();
           if($aportante == null){
                DB::table('tabla_aportantes')->insert([
                    'nombre' => $elemento['nombre'],
                    'proceso' => $elemento['proceso']== null? 'NOMINA': $elemento['proceso'],
                    'cedula' => $elemento['cedula'],
                    'sueldo' => 0,
                    'tipo' => 'APORTANTE'
                ]);
           }
        }       
        return 'COMPLETADO';
    } 

    public function faltantes_aportantes(Request $datos){
        $cedulas = $datos->cedulas;
        $aportantes = DB::table('tabla_aportantes')->whereNotIn('cedula', $cedulas)->get();
        return $aportantes;
    }

    public function diferenciacion(Request $datos){
        $cedulas = $datos->cedulas;
        $aportantes = DB::table('tabla_aportantes')->whereIn('cedula', $cedulas)->get();
        return $aportantes;
    }

    public function guardar(Request $datos){
        foreach ($datos->elementos as $elemento) {
            $codigo = time() + rand(time(), time()*2);
            $aportante = DB::table('tabla_aportantes')->where('cedula', $elemento['cedula'])->first();
            $sueldo = $aportante->sueldo;
            $estado = 'NORMAL';
            if($elemento['valor'] == 0) $estado = 'SOBREGIRO';
            
            $importe = ($aportante->tipo == 'SOCIO')? 2 : 1 ;

            $importe = $sueldo * $importe/100;
            if($elemento['valor'] > $importe) $estado = ($sueldo !=0 )? 'CUBRE SOBREGIRO' : 'NORMAL';           

            DB::table('tabla_mes_aportacion')->insert([
                'c_codigo' => $codigo,
                'aportante' => $aportante->id,
                'anual' =>$datos->anual,
                'mensual' =>$datos->mensual,
                'valor' => $elemento['valor'],
                'aporte' => $elemento['aporte'],
                'ahorro' => $elemento['ahorro'],
                'estado' => $estado
            ]);
        } 
        return 'OK' ; 
    }

    public function detalles(Request $datos){
        $respuesta = array();
        foreach ($datos->cedulas as $cedula) {
            $aportante = DB::table('tabla_aportantes')->where('cedula', $cedula)->first();
            $aportaciones = DB::table('tabla_mes_aportacion')
            ->where('aportante', $aportante->id)
            ->orderBy('anual')
            ->orderBy('mensual')
            ->get();
            array_push($respuesta, ['aportante' =>$aportante, 'aportaciones' => $aportaciones]);
        }
        return $respuesta;
    }

    public function listado_aportantes(){
        $aportantes = DB::table('tabla_aportantes')->get();
        return view('socios.listado', ['socios' => $aportantes]);
    }

    public function cambio_tipo(Request $datos){
        DB::table('tabla_aportantes')->where('id', $datos->id)->update([
            'tipo' => $datos->tipo
        ]);
        return 'OK';
    }

    public function detalle_aportante($codigo){
        $aportante = DB::table('tabla_aportantes')->where('id', $codigo)->get()->first();
        return response()->json(array('datos' => $aportante));   
    }

    public function actualizar(Request $datos){
        DB::table('tabla_aportantes')->where('cedula', $datos->cedula)->update([
            'nombre' => $datos['nombre'],
            'proceso' => $datos['proceso']== null? 'NOMINA': $datos['proceso'],
            'sueldo' => $datos->sueldo,
        ]);
        return redirect(route('listado_aportantes'))->with('status', "Aportante " . $datos['nombre'] . " ha sido actualizado");
    }

    public function eliminar_aportante (Request $datos){
        DB::table('tabla_mes_aportacion')->where('aportante', $datos->codigo)->delete();
        DB::table('tabla_aportantes')->where('id', $datos->codigo)->delete();
        return 'OK';
    }

    public function anadir(Request $datos){
        $aportante = DB::table('tabla_aportantes')->where('cedula', $datos->cedula_a)->get()->first();
        if($aportante == null){
            DB::table('tabla_aportantes')->insert([
                'nombre' => $datos['nombre_a'],
                'proceso' => $datos['proceso_a']== null? 'NOMINA': $datos['proceso_a'],
                'cedula' => $datos['cedula_a'],
                'sueldo' => $datos['sueldo_a'],
                'tipo' => $datos['tipo_a']
            ]);
            return redirect(route('listado_aportantes'))->with('status', "Aportante ingreado con éxito");
        }
        return redirect(route('listado_aportantes'))->with('error', "Ya xiste un aportante con esta cédula");
    }

    public function eliminarRegMen(Request $datos){
        DB::table('tabla_mes_aportacion')
        ->where('anual', $datos->anual)
        ->where('mensual', $datos->mensual)
        ->delete();
        return 'OK';
    }
}

