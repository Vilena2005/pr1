<?php

use Src\Route;

//Главная страница
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');

//Route::add('GET', '/edit', [Controller\Site::class, 'edit_site'])
//    ->middleware('auth');


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

    //Редактирование Подразделения


    //Создание Абонента
Route::add('GET', '/add-abonent', [Controller\AbonentController::class, 'make'])
    ->middleware('auth');
Route::add('POST', '/add-abonent', [Controller\AbonentController::class, 'abonent'])
    ->middleware('auth');

    //Редактирование Абонента
//Route::add('GET', '/edit-abonent/{id}', [Controller\AbonentController::class, 'edit'])
//    ->middleware('auth');
//Route::add('POST', '/edit-abonent/{id}', [Controller\AbonentController::class, 'update'])
//    ->middleware('auth');

// Удаление абонента
//Route::add('POST', '/delete-abonent', [Controller\AbonentController::class, 'delete'])
//    ->middleware('auth');
//Route::add('POST', '/delete-abonent', [Controller\AbonentController::class, 'deleteSelected'])
//    ->middleware('auth');

// Маршрут для отображения страницы удаления (список абонентов для выбора)
Route::add('GET', '/abonents-delete', [Controller\AbonentController::class, 'deleteList'])
    ->middleware('auth');

// Маршрут для обработки удаления выбранных абонентов
Route::add('POST', '/abonents/delete-selected', [Controller\AbonentController::class, 'deleteSelected'])
    ->middleware('auth');



//Route::add('POST', '/edit-abonent', [Controller\AbonentController::class, 'delete'])
//    ->middleware('auth');


    //Создание помещения
Route::add('GET', '/add-room', [Controller\RoomController::class, 'make_room'])
    ->middleware('auth');
Route::add('POST', '/add-room', [Controller\RoomController::class, 'room'])
    ->middleware('auth');