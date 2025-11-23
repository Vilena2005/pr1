<?php

namespace Middlewares;

use src\Auth\Auth;
use Src\Response;

class AdminMiddleware
{
//    public function handle()
//    {
//        if (Auth::role() !== 3)
//            app()->route->redirect("/login");
//    }

    public function handle($request): ?object
    {
        $user = Auth::user();

        if (!$user || $user->role !== 3) {
            (new Response([
                'status' => 'error',
                'message' => 'Доступ запрещен. Только администраторы могут выполнять это действие.'
            ]))->json(403);
            exit;
        }

        return $request;
    }
}