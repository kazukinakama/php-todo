<?php

namespace src\controllers;

require dirname(__FILE__, 2) . '/models/model.php';
require dirname(__FILE__, 2) . '/models/todo.php';

use src\models\Todo;

class TodoController
{
    public function index(): void
    {
        $todo = new Todo();
        echo json_encode($todo->findMany());
    }

    public function store(): void
    {
        $todo = new Todo();
        $todo->create();
    }

    public function show(int $id): void
    {
        $todo = new Todo();
        echo json_encode($todo->findOne($id));
    }

    public function update(int $id): void
    {
        $todo = new Todo();
        $todo->update($id);
    }

    public function destroy(int $id): void
    {
        $todo = new Todo();
        $todo->delete($id);
    }
}
