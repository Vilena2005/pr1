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

    public function make (): string
    {
        $divisions = Division::all();
        return new View('site.add-abonent', compact('divisions'));
    }

    public function abonent (Request $request): string
    {
        $data = $request->all();
        $errors = [];

        // Проверка полей
        foreach (['surname', 'name', 'patronym', 'birth_date','phone'] as $field) {
            if (empty($data[$field])) {
                $errors[] = "Поле {$field} обязательно для заполнения.";
            } else {
                $len = mb_strlen($data[$field]);
                if ($len < 3) {
                    $errors[] = "Поле {$field} должно содержать минимум 3 символа.";
                }
                if ($len > 255) {
                    $errors[] = "Поле {$field} должно содержать максимум 255 символов.";
                }
            }
        }

        // Если есть ошибки — возвращаем вью с ошибками и не создаём объект
        if (!empty($errors)) {
            return new View('site.add-abonent', [
                'errors' => $errors,
                'old' => $data
            ]);
        }

        Abonent::create([
            'surname' => trim($data['surname']),
            'name' => trim($data['name']),
            'patronym' => trim($data['patronym']),
            'birth_date' => $data['birth_date'],
            'division_id' => ($data['division_id'] ?? ''),
            'phone' => trim($data['phone']),
        ]);

        return new View('site.add-abonent', ['message' => 'Абонент создан']);
    }

    public function edit_abonent (): string
    {
        $divisions = Division::all();
        return new View('site.edit-abonent', compact('divisions'));
    }

    public function edit (Request $request, int $id): string
    {
        $abonent = Abonent::find($id);
        if (!$abonent) {
            return new View('site.abonent', ['message' => 'Абонент не найден']);
        }

        if ($request->method() === 'POST') {
            if ($request->get('action') === 'delete') {
                // Удаляем абонента
                $abonent->delete();

                // Редирект или отображение сообщения после удаления
                app()->route->redirect('/abonent');
            }

            // Если это обновление (редактирование)
            $data = $request->all();
            $errors = [];

            // Валидация
            foreach (['surname', 'name', 'patronym', 'birth_date', 'phone'] as $field) {
                if (empty($data[$field])) {
                    $errors[] = "Поле {$field} обязательно для заполнения.";
                } else {
                    $len = mb_strlen($data[$field]);
                    if ($len < 3) {
                        $errors[] = "Поле {$field} должно содержать минимум 3 символа.";
                    }
                    if ($len > 255) {
                        $errors[] = "Поле {$field} должно содержать максимум 255 символов.";
                    }
                }
            }

            if (!empty($errors)) {
                return new View('site.edit-abonent', [
                    'errors' => $errors,
                    'abonent' => (object) $data,
                    'divisions' => Division::all()
                ]);
            }

            // Обновление данных
            $abonent->update([
                'surname' => trim($data['surname']),
                'name' => trim($data['name']),
                'patronym' => trim($data['patronym']),
                'birth_date' => $data['birth_date'],
                'division_id' => ($data['division_id'] ?? null) ?: null,
                'phone' => trim($data['phone']),
            ]);

            return new View('site.edit-abonent', [
                'message' => 'Абонент обновлён',
                'abonent' => $abonent,
                'divisions' => Division::all()
            ]);
        }

        // просто показываем форму с данными абонента
//        return new View('site.edit-abonent', [
//            'abonent' => $abonent,
//            'divisions' => Division::all(),
//            'message' => '',
//        ]);
    }


}