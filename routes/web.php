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

//страница Помещения
Route::add('GET', '/room', [Controller\RoomController::class, 'index_room'])
    ->middleware('auth');

//страница Подразделения
Route::add('GET', '/division', [Controller\DivisionController::class, 'division_see'])
    ->middleware('auth');


//Админ
    //Создание Подразделения
Route::add('GET', '/add-division', [Controller\DivisionController::class, 'division_make'])
    ->middleware('auth');
Route::add('POST', '/add-division', [Controller\DivisionController::class, 'division'])
    ->middleware('auth');

//Удаление Подразделения
Route::add('GET', '/divisions-delete', [Controller\DivisionController::class, 'divisionDeleteList'])
    ->middleware('auth');
Route::add('POST', '/divisions/delete-selected', [Controller\DivisionController::class, 'divisionDeleteSelected'])
    ->middleware('auth');


    //Создание Абонента
Route::add('GET', '/add-abonent', [Controller\AbonentController::class, 'make'])
    ->middleware('role:admin');
Route::add('POST', '/add-abonent', [Controller\AbonentController::class, 'abonent'])
    ->middleware('auth');

    // Удаление абонента
Route::add('GET', '/abonents-delete', [Controller\AbonentController::class, 'abonentDeleteList'])
    ->middleware('auth');
Route::add('POST', '/abonents/delete-selected', [Controller\AbonentController::class, 'abonentDeleteSelected'])
    ->middleware('auth');


    //Создание помещения
Route::add('GET', '/add-room', [Controller\RoomController::class, 'make_room'])
    ->middleware('auth');
Route::add('POST', '/add-room', [Controller\RoomController::class, 'room'])
    ->middleware('auth');

    // Удаление помещения
Route::add('GET', '/rooms-delete', [Controller\RoomController::class, 'roomDeleteList'])
    ->middleware('auth');
Route::add('POST', '/rooms/delete-selected', [Controller\RoomController::class, 'roomDeleteSelected'])
    ->middleware('auth');



