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
