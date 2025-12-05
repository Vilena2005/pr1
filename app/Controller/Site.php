<?php

namespace Controller;

use Model\Post;
use Model\Role;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use Model\User;
use Src\Auth\Auth;


class Site
{
    public function hello(): string
    {
        return new View('site.hello', ['message' => 'Вы успешно вошли']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator(
                $data,
                [
                    'name'     => ['required'],
                    'login'    => ['required', 'unique:users,login'],
                    'password' => ['required'],
                ],
                [
                    'required' => 'Поле :field пусто',
                    'unique'   => 'Поле :field должно быть уникальным',
                ]
            );

            $passwordValidator = new \Src\Validator\PasswordValidator($data['password'] ?? '');

            if ($validator->fails() || $passwordValidator->fails()) {
                $errors = $validator->errors();

                if ($passwordValidator->fails()) {
                    $errors['password'] = array_merge(
                        $errors['password'] ?? [],
                        $passwordValidator->errors()
                    );
                }

                $message = 'Проверьте правильность заполнения полей.';

                if (isset($errors['login'])) {
                    $message = 'Неподходящий логин';
                }

                return new View('site.signup', [
                    'errors' => $errors,
                    'old'    => $data,
                    'message' => $message,
                ]);
            }

            $data['password'] = md5($data['password']);

            if (User::create($data)) {
                app()->route->redirect('/login');
            }

            return new View('site.signup', [
                'message' => 'Ошибка при создании пользователя. Попробуйте позже.',
                'old'     => $data
            ]);
        }

        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }


}
