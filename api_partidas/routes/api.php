<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//rotas para visualizar os registros

Route::get('/', function () {return response()->json(['status' => 'success',], 200);});
Route::get('/partidas',[PartidaController::class,'index'])->name('partidas.index');
Route::get('/partidas/{id}',[PartidaController::class,'show'])->name('partidas.show');

//rotas para inserir 
Route::post('/partidas',[PartidaController::class,'store'])->name('partidas.store');

//rotas para atualizar os registros
Route::put('/partidas/{id}',[PartidaController::class,'update'])->name('partidas.update');

//rotas para deletar os registros
Route::delete('/partidas/{id}',[PartidaController::class,'destroy'])->name('partidas.destroy');