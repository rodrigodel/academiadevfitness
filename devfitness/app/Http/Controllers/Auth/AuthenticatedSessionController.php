<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthenticatedSessionController extends Controller
{
    /**
     * Autenticar e gerar o token de API Sanctum.
     */
    public function store(Request $request)
    {
        // Validação das credenciais enviadas
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Tentar fazer o login usando as credenciais
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Se a autenticação for bem-sucedida, gerar o token de API Sanctum
        $user = $request->user();
        $token = $user->createToken('API Token')->plainTextToken;

        // Retornar o token gerado e os dados do usuário
        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    /**
     * Deslogar e invalidar o token.
     */
    public function destroy(Request $request)
    {
        // Invalidar todos os tokens do usuário ao fazer logout
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }
}
