<?php

use Illuminate\Support\Facades\Route;

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





Route::get('/registroProfesor', array(
    'as' => 'registroProfesor',
    
    'uses' => 'registroProfesorController@registroProfesor'
));



Route::get('/segundoParcial', array(
    'as' => 'segundoParcial',
    
    'uses' => 'SegundoParcialController@segundoParcial'
));


Route::get('/registroCliente', array(
    'as' => 'registroCliente',
    
    'uses' => 'RegistroClienteController@registroCliente'
));


Route::post('/upload-respuestas-json', 'SegundoParcialController@uploadJsonFile')->name('uploadRespuestas.json');
Route::post('/upload-json', 'SegundoParcialController@uploadJsonFilePreguntas')->name('upload.json');
