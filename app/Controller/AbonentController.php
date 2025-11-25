<?php

namespace Controller;

use Model\Abonent;
use Model\Division;
use Src\Request;
use Src\View;


class AbonentController
{
    public function index (): string
    {
        return new View('site.abonent', ['abonents' => Abonent::all() ]);
    }
//    public function see ()
//    {
//        $abonents = Abonent::all();
//
//        return new View('site.abonent', [
//            'abonents' => $abonents,
//            'errors' => $errors ?? [],
//            'old' => $data ?? []
//        ]);
//    }
    public function make (): string
    {
        $divisions = Division::all();
        return new View('site.add-abonent', compact('divisions'));
    }
//    public function make (): string
//    {
//        return new View('site.add-abonent');
//    }

    public function abonent (Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            // валидация
            $errors = [];

            if (empty(trim($data['surname'] ?? ''))) {
                $errors['surname'] = 'Фамилия обязательна';
            }
            if (empty(trim($data['name'] ?? ''))) {
                $errors['name'] = 'Имя обязательно';
            }
            if (empty(trim($data['phone'] ?? ''))) {
                $errors['phone'] = 'Номер телефона обязателен';
            }


            if (!empty($errors)) {
                return new View('site.abonent', [
                    'errors' => $errors,
                    'old' => $data,
                    'abonents' => Abonent::all()
                ]);
            }

            $properties = [
                'surname' => trim($data['surname']),
                'name' => trim($data['name']),
                'patronym' => trim($data['patronym']),
                'birth_date' => !empty($data['birth_date']) ? $data['birth_date'] : null,
                'division_id' => trim($data['division_id'] ?? ''),
                'phone' => trim($data['phone']),
            ];

            if (Abonent::create($properties)) {
                app()->route->redirect('/abonent'); // Перенаправление
            } else {
                $errors['general'] = 'Не удалось сохранить абонента';
            }
        }

        // форма и список
        $abonents = Abonent::all();

        return new View('site.abonent', [
            'abonents' => $abonents,
            'errors' => $errors ?? [],
            'old' => $data ?? []
        ]);
    }
}