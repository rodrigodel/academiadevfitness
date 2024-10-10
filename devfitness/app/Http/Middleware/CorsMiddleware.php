<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        
        \log()::info('Middleware CORS executado para a rota: ' . $request->path());

        $allowedOrigins = [
            'https://rodrigozambon.com',
            'https://www.rodrigozambon.com.br',
        ];

        $origin = $request->headers->get('Origin');

        /** Tratamento para requisições OPTIONS */
        if ($request->isMethod('OPTIONS')) {
            $headers = [
                'Access-Control-Allow-Origin'      => in_array($origin, $allowedOrigins) ? $origin : '',
                'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, Accept, Origin',
                'Access-Control-Allow-Credentials' => 'true',
            ];
            return response()->json('OK', 200, $headers);
        }

        $response = $next($request);

        /** Adiciona os cabeçalhos na resposta */
        $response->headers->set('Access-Control-Allow-Origin', in_array($origin, $allowedOrigins) ? $origin : '');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin');

        return $response;
    }
}

