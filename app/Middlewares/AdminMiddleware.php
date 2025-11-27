<?php

namespace Middlewares;

use src\Auth\Auth;
use Src\Response;

class AdminMiddleware
{
    public function handle($request): ?object
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            (new Response([
                'status' => 'error',
                'message' => 'Доступ запрещен.'
            ]))->json(403);
            exit;
        }

        return $request;
    }
}