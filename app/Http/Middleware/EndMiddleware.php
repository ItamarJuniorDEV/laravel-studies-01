<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EndMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // vai guardar toda a resposta dentro do response 
        $response = $next($request);

        // vai ser executado depois da resposta ($response)
        echo '<p>EndMiddleware</p>';

        // retornará o resultado da requisição
        return $response;
    }
}
