<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartidaController extends Controller
{
    public function index()
    {
        $registros = Partida::all();
        $contador = $registros->count();
        if ($contador > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Partidas encontradas',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'status' => 'info',
                'message' => 'Nenhuma partida encontrada',
                'data' => []
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data_partida' => 'required|date',
            'time_casa' => 'required|string|max:255',
            'time_visitante' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = Partida::create($request->all());

        if ($registros) {
            return response()->json([
                'status' => 'success',
                'message' => 'Partida cadastrada com sucesso',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao cadastrar partida'
            ], 500);
        }
    }

    public function show(Partida $partida)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Partida encontrada',
            'data' => $partida
        ], 200);
    }

    public function update(Request $request, Partida $partida, $id)
    {
        $validator = Validator::make($request->all(), [
            'data_partida' => 'sometimes|date',
            'time_casa' => 'sometimes',
            'time_visitante' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $partida = Partida::find($id);

        if (!$partida) {
            return response()->json([
                'status' => 'error',
                'message' => 'Partida não encontrada'
            ], 404);
        }

        $partida->data_partida = $request->data_partida;
        $partida->time_casa = $request->time_casa;
        $partida->time_visitante = $request->time_visitante;

        if ($partida->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Partida atualizada com sucesso',
                'data' => $partida
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar partida'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $partida = Partida::find($id);
        if (!$partida) {
            return response()->json([
                'status' => 'error',
                'message' => 'Partida não encontrada'
            ], 404);
        }
        if ($partida->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Partida excluída com sucesso'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir partida'
            ], 500);
        }
    }
}