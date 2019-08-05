<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ReservaController extends Controller
{
    public function sala_reservacion(){
        $salas = DB::table('tabla_sala_eventos')->where('existencia', true)->get();
        return view('salas.sala_eventos',['salas' => $salas]);
    }

    public function anadir_sala(Request $datos){
        DB::table('tabla_sala_eventos')->insert([
            'nombre' => $datos->nombre,
            'descripcion' => $datos->descripcion,
            'capacidad' => $datos->capacidad,
            'precio' => $datos->precio
        ]);
        return redirect(route('sala_reservacion'))->with('status', 'Sala de eventos añadida correctamente');
    }

    public function detalle_sala($codigo){
        $sala = DB::table('tabla_sala_eventos')->where('id', $codigo)->get()->first();
        return response()->json(array('datos' => $sala));  
    }

    public function editar_sala(Request $datos){
        DB::table('tabla_sala_eventos')->where('id', $datos->id)->update([
            'nombre' => $datos->nombre,
            'descripcion' => $datos->descripcion,
            'capacidad' => $datos->capacidad,
            'precio' => $datos->precio
        ]);
        return redirect(route('sala_reservacion'))->with('status', 'Sala de eventos actualizada correctamente');
    }

    public function eliminar_sala(Request $datos){
        DB::table('tabla_sala_eventos')
        ->where('id', $datos->codigo)
        ->update(['existencia' => false]);
        return redirect(route('sala_reservacion'))->with('status', 'Sala de eventos eliminada correctamente');
    }

    public function reservaciones(){
        $salas =  DB::table('tabla_sala_eventos')->where('existencia', true)->get();
        return view('salas.reservaciones', ['salas' => $salas]);
    }

    public function guardar_reserva(Request $datos){
        $pago = ($datos->pagado == null) ? false: true;
        date_default_timezone_set('America/Guayaquil');

        $fecha_inicial = date('Y-m-d H:i:s', $datos->fecha_ini . ' ' . $datos->hora_ini);
        $fecha_final = date('Y-m-d H:i:s',$datos->fecha_fin . ' ' . $datos->hora_fin);

        

        DB::table('tabla_reservaciones')->insert([
            'fecha_hora_inicio' => $fecha_inicial,
            'fecha_hora_final' => $fecha_final,
            'reservante' => $datos->nombre,
            'cedula' => $datos->cedula,
            'pagado' =>$pago,
            'fecha_hora_reservacion' => date('Y-m-d H:i:s')
        ]);


    }
}
