<?php

use Src\Route;

//Главная страница
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');

//Авторизация и выход
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

//страница Абоненты
Route::add('GET', '/abonent', [Controller\AbonentController::class, 'index'])
    ->middleware('auth');


//Админ
Route::add('GET', '/division', [Controller\DivisionController::class, 'division_see'])
    ->middleware('auth');

    //Создание Подразделения
Route::add('GET', '/add-division', [Controller\DivisionController::class, 'division_make'])
    ->middleware('auth');
Route::add('POST', '/add-division', [Controller\DivisionController::class, 'division'])
    ->middleware('auth');


    //Создание Абонента
Route::add('GET', '/add-abonent', [Controller\AbonentController::class, 'make'])
    ->middleware('auth');
Route::add('POST', '/add-abonent', [Controller\AbonentController::class, 'abonent'])
    ->middleware('auth');;
