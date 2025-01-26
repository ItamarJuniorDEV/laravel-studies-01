<?php

use App\Http\Middleware\StartMiddleware;
use App\Http\Middleware\EndMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // vai adicionar o middleware antes de ser escutado em todas as rotas
        // prepend = escutar antes das rotas
        // $middleware->prepend([
        //     StartMiddleware::class,
        //    EndMiddleware::class,
        // ]);

        // vai adicionar o middleware depois de ser escutado em todas as rotas
        // // append = escutar depois das rotas
        // $middleware->append([
        //    StartMiddleware::class,
        //     EndMiddleware::class,
        // ]);

        // criar grupo de middlewares
        $middleware->prependToGroup('correr_antes', [
            StartMiddleware::class

        ]);

        $middleware->appendToGroup('correr_depois', [
            EndMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
