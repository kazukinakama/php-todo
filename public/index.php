<?php

require dirname(__FILE__, 2) . '/src/controllers/todo-controller.php';

use src\controllers\TodoController;

$url = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];
$params = explode('/', $url);
$id = $params[2] ?? null;

$todoController = new TodoController();

switch ("$method: $url") {
    case 'GET: /todos':
        $todoController->index();
        break;
    case 'POST: /todos':
        $todoController->store();
        break;
    case "GET: /todos/$id":
        $todoController->show((int) $id);
        break;
    case "PUT: /todos/$id":
        $todoController->update((int) $id);
        break;
    case "DELETE: /todos/$id":
        $todoController->destroy((int) $id);
        break;
}
