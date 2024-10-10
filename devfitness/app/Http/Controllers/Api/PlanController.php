<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    // Listar todos os planos de um membro
    public function index($memberId)
    {
        $plans = Plan::where('member_id', $memberId)->get();
        return response()->json($plans);
    }

    // Exibir um plano específico
    public function show($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plano não encontrado'], 404);
        }

        return response()->json($plan);
    }

    // Criar um novo plano
    public function store(Request $request)
    {
        $plan = Plan::create($request->all());
        return response()->json($plan, 201);
    }

    // Atualizar um plano existente
    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);
        
        if (!$plan) {
            return response()->json(['message' => 'Plano não encontrado'], 404);
        }

        $plan->update($request->all());
        return response()->json($plan);
    }

    // Deletar um plano
    public function destroy($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plano não encontrado'], 404);
        }

        $plan->delete();
        return response()->json(['message' => 'Plano deletado com sucesso']);
    }
}
