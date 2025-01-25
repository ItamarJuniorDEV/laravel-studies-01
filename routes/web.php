<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\OnlyAdmin;

// assinatura base de uma rota
// Route::verbo('uri', callback); - O callback é a ação que vai ser executada quando chamada

// rota com função anônima
Route::get('/rota', function () {
  return '<h1>Olá Laravel</h1>';
});

Route::get('/user', function () {
  return '<h1>Aqui está o usuário</h1>';
});

Route::get('/injection', function (request $request) {
  var_dump($request);
});

Route::match(['get', 'post'], '/match', function (request $request) {
  return '<h1>Aceita GET e POST</h1>';
});

Route::any('/any', function (request $request) {
  return '<h1>Aceita qualquer http method</h1>';
});

// Rotas com controladores
Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);

// Redirecionamento (temporário) - 302 | Se chamar o /saltar, a tela será redirecionada para /index
Route::redirect('/saltar', '/index');

// Redirecionamento (permanente) - 301 | Se chamar o /saltar2, a tela será redirecionada para /index
Route::permanentRedirect('/saltar2', '/index');

// Rota para view
Route::view('/view', 'home');

// Ao acessar /view2, irá apresentar a página /home com o nome Itamar Junior
Route::view('/view2', 'home', ['myName' => "Itamar Junior"]);

// Caso queira analisar as rotas criadas, digite no terminal:
// php artisan route:list

// ---------------------------------------
// ROUTE PARAMETERS
// ---------------------------------------
Route::get('/valor/{value}', [MainController::class, 'mostrarValor']);

// Passando vários valores
Route::get('/valores/{value1}/{value2}', [MainController::class, 'mostrarValores']);
Route::get('/valores2/{value1}/{value2}', [MainController::class, 'mostrarValores2']);

// Com o "?", será mostrado o valor opcional
Route::get('/opcional/{value?}', [MainController::class, 'mostrarValorOpcional']);

// O segundo parâmetro será opcional
Route::get('/opcional1/{value1}/{value?}', [MainController::class, 'mostrarValorOpcional2']);

// Será passado o ID do usuário e o ID do post por parâmetro para o controlador
Route::get('/user/{user_id}/post/{post_id}', [MainController::class, 'mostrarPosts']);

// ---------------------------------------
// ROUTE PARAMETERS WITH CONSTRAINTS
// ---------------------------------------

// Com a constraint, será aceito apenas os valores numéricos
Route::get('/exp1/{value}', function ($value) {
  echo $value;
})->where('value', '[0-9]+');

// Com a constraint, será aceito valores númericos e letras maiúsculas e minúsculas
Route::get('/exp2/{value}', function ($value) {
  echo $value;
})->where('value', '[A-Za-z0-9]+');

// 
Route::get('/exp3/{value1}/{value2}', function ($value) {
  echo $value;
})->where([
  'value1' => '[0-9]+',
  'value2' => '[A-Za-z0-9]+'
]);

// ---------------------------------------
// ROUTE NAMES
// ---------------------------------------
Route::get('/rota_abc', function () {
  return 'Rota nomeada';
})->name('rota_nomeada');

// Rota que redireciona para a rota nomeada
Route::get('/rota_referenciada', function () {
  return redirect()->route('rota_nomeada');
});

Route::prefix('admin')->group(function () {
  Route::get('/home', [MainController::class, 'index']);
  Route::get('/about', [MainController::class, 'about']);
  Route::get('/management', [MainController::class, 'mostraValor']);
});
/*
/admin/home
/admin/about
/admin/management
*/

// Middleware
Route::get('/admin/only', function () {
  echo 'Apenas administradores!';
})->middleware([OnlyAdmin::class]);

// // Outra forma de usar o Middleware
Route::middleware([OnlyAdmin::class])->group(function () {
  Route::get('/admin/only2', function () {
    return 'Apenas administradores!';
  });
  Route::get('/admin/only3', function () {
    return 'Apenas administradores 2!';
  });
});
// Rotas usando group
Route::get('/new', [UserController::class, 'new']);
Route::get('/edit', [UserController::class, 'edit']);
Route::get('/delete', [UserController::class, 'delete']);

// Outra forma de usar group
Route::controller(UserController::class)->group(function () {
  Route::get('/user/new', 'new');
  Route::get('/user/edit', 'edit');
  Route::get('/user/delete', 'delete');
});
// Se nenhuma rota for encontrada:
Route::fallback(function () {
  echo 'PÁGINA NÃO ENCONTRADA!';
});
