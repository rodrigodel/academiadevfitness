<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota de Login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rota de Logout (protegida, pois o usuário precisa estar autenticado para fazer logout)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

// Rotas protegidas pelo Sanctum (somente usuários autenticados com token podem acessar)
Route::middleware('auth:sanctum')->group(function () {

    // Rotas de Membros
    Route::get('/members', [MemberController::class, 'index']);
    Route::get('/members/{id}', [MemberController::class, 'show']);
    Route::post('/members', [MemberController::class, 'store']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    // Rotas de Pagamentos
    Route::get('payments/{memberId}', [PaymentController::class, 'index']); // Listar todos os pagamentos de um membro
    Route::get('payments/show/{id}', [PaymentController::class, 'show']);   // Exibir um pagamento específico
    Route::post('payments', [PaymentController::class, 'store']);           // Criar um novo pagamento
    Route::put('payments/{id}', [PaymentController::class, 'update']);      // Atualizar um pagamento
    Route::delete('payments/{id}', [PaymentController::class, 'destroy']);  // Deletar um pagamento

    // Listar os pagamentos de um membro específico
    Route::get('members/{id}/payments', [MemberController::class, 'payments']);

    // Rota para listar os planos de um membro específico
    Route::get('members/{id}/plans', [MemberController::class, 'plans']);
});

