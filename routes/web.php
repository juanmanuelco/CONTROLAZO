<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','AportantesController@index')->name('index');
Route::get('/reporte/{ano}/{mes}','AportantesController@cargarAportes')->name('cargarAportes');
Route::get('/reporte/{ano}/{mes}','AportantesController@reportes_viejos')->name('reportes_viejos');

Route::post('/aportantes/todos', 'AportantesController@todos_aportantes')->name('todos_aportantes');
Route::post('/aportantes/no_hoja', 'AportantesController@faltantes_aportantes')->name('faltantes_aportantes');

Route::post('/aportantes/diferenciacion', 'AportantesController@diferenciacion')->name('diferenciacion');
Route::post('/aportantes/guardar', 'AportantesController@guardar')->name('guardar');

Route::post('/aportantes/detalles', 'AportantesController@detalles')->name('dtalles');

Route::get('/aportantes/todos', 'AportantesController@listado_aportantes')->name('listado_aportantes');

Route::post('/cambio_tipo', 'AportantesController@cambio_tipo')->name('cambio_tipo');

Route::get('/detalle_aportante/{codigo}', 'AportantesController@detalle_aportante')->name('detalle_aportante');

Route::post('/aportante/actualizar', 'AportantesController@actualizar')->name('actualizar');

Route::post('/eliminar_aportante',  'AportantesController@eliminar_aportante')->name('eliminar_aportante');

Route::post('/anadir/aportante', 'AportantesController@anadir')->name('anadir');

Route::post('/eliminar-registro-mensual', 'AportantesController@eliminarRegMen')->name('eliminarRegMen');

Route::get('/sala_reservacion', 'ReservaController@sala_reservacion')->name('sala_reservacion');

Route::post('/anadir_sala', 'ReservaController@anadir_sala')->name('anadir_sala');


Route::get('/detalle_sala/{codigo}', 'ReservaController@detalle_sala')->name('detalle_sala');
Route::post('/editar_sala', 'ReservaController@editar_sala')->name('editar_sala');

Route::post('/eliminar_sala', 'ReservaController@eliminar_sala')->name('eliminar_sala');

Route::get('/reservaciones', 'ReservaController@reservaciones')->name('reservaciones');


Route::post('/guardar_reserva', 'ReservaController@guardar_reserva')->name('guardar_reserva');