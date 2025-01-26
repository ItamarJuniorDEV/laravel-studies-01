<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\StartMiddleware;
use App\Http\Middleware\EndMiddleware;
use Illuminate\Support\Facades\Route;

//Route::get('/', [MainController::class, 'index'])->name('index');
//Route::get('/about', [MainController::class, 'about'])->name('about');
//Route::get('/contact', [MainController::class, 'contact'])->name('contact');

//Primeiro escuta o que estará dentro do middleware e após isso, executa o controller

// A rota inicial será afetada apenas pelo start middleware.

/*
Route::get('/', [MainController::class, 'index'])->name('index')->middleware([StartMiddleware::class]);
Route::get('/about', [MainController::class, 'about'])->name('about')->middleware([StartMiddleware::class, EndMiddleware::class]);
Route::get('/contact', [MainController::class, 'contact'])->name('contact');*/

// Usamos o withoutMiddleware para que a rota about não escuto o método selecionado ao lado
// Juntando as rotas que vão ter StartMiddleware e EndMiddleware em um grupo
// Route::middleware(StartMiddleware::class, EndMiddleware::class)->group(function () {
//   Route::get('/', [MainController::class, 'index'])->name('index');
//   Route::get('/about', [MainController::class, 'about'])->name('about')->withoutMiddleware([EndMiddleware::class]);
//   Route::get('/contact', [MainController::class, 'contact'])->name('contact');
// });

Route::middleware(['correr_depois'])->group(function () {
  Route::get('/', [MainController::class, 'index'])->name('index');
  Route::get('/about', [MainController::class, 'about'])->name('about');
  Route::get('/contact', [MainController::class, 'contact'])->name('contact');
});
