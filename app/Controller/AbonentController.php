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

//    public function edit(int $id, Request $request): string
//    {
//        // Получаем абонента
//        $abonent = Abonent::find($id);
//        if (!$abonent) {
//            return new View('site.error', ['message' => 'Абонент не найден']);
//        }
//
//        // Если GET-запрос — просто отображаем форму с текущими данными
//        if ($request->method() === 'GET') {
//            return new View('site.edit-abonent', [
//                'abonent' => $abonent,
//                'divisions' => Division::all()
//            ]);
//        }
//
//        // Если POST — обработка обновления
//        $data = $request->all();
//        $errors = [];
//
//        foreach (['surname', 'name', 'patronym', 'birth_date', 'phone'] as $field) {
//            if (empty($data[$field])) {
//                $errors[] = "Поле {$field} обязательно для заполнения.";
//            } else {
//                $len = mb_strlen($data[$field]);
//                if ($len < 3) {
//                    $errors[] = "Поле {$field} должно содержать минимум 3 символа.";
//                }
//                if ($len > 255) {
//                    $errors[] = "Поле {$field} должно содержать максимум 255 символов.";
//                }
//            }
//        }
//
//        if (!empty($errors)) {
//            return new View('site.edit-abonent', [
//                'errors' => $errors,
//                'abonent' => (object) $data, // Чтобы форма отобразила введённые данные
//                'divisions' => Division::all()
//            ]);
//        }
//
//        // Обновляем поля
//        $abonent->update([
//            'surname' => trim($data['surname']),
//            'name' => trim($data['name']),
//            'patronym' => trim($data['patronym']),
//            'birth_date' => $data['birth_date'],
//            'division_id' => $data['division_id'] ?? null,
//            'phone' => trim($data['phone']),
//        ]);
//
//        return new View('site.edit-abonent', [
//            'message' => 'Абонент обновлён',
//            'abonent' => $abonent,
//            'divisions' => Division::all()
//        ]);
//    }

//    public function delete_abonent_list (): string
//    {
//        $abonents = Abonent::all();
//
//        return new View('site.abonents-delete-list', ['abonents' => $abonents]);
//    }
//
//    // Обработка удаления выбранных абонентов
//    public function deleteSelected (Request $request)
//    {
//        $ids = $request->get('ids', []);
//
//        if (!empty($ids) && is_array($ids)) {
//            Abonent::whereIn('id', $ids)->delete();
//        }
//
//        // После удаления можно редиректить или показывать сообщение
//        header('Location: /abonents/delete');
//        exit;
//    }

//    public function delete_abonent (Request $request): string
//    {
//        $data = $request->all();
//        $ids = $data['abonent_ids'] ?? [];
//        $abonents = Abonent::whereIn('id', $ids)->get();
//
//        Abonent::destroy($ids);
//
//        return new View('site/abonent', [
//           'abonents' => Abonent::all(),
//            'message' => 'Абонент удален'
//        ]);
//    }
    public function edit_abonent (): string
    {
        $divisions = Division::all();
        return new View('site.edit-abonent', compact('divisions'));
    }

    public function edit (Request $request, int $id): string
    {
        $abonent = Abonent::find($id);
        if (!$abonent) {
            return new View('site.error', ['message' => 'Абонент не найден']);
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

            // Валидация (пример с длиной и заполненностью полей)
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

        // GET запрос — просто показываем форму с данными абонента
        return new View('site.edit-abonent', [
            'abonent' => $abonent,
            'divisions' => Division::all()
        ]);
    }


}