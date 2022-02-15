<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService
{

    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getTodoItems($name, $finish, $size)
    {
        return $this->todoRepository->getTodoItems($name, $finish, $size);
    }

    public function getAllTodoItems()
    {
        return $this->todoRepository->getAllTodoItems();
    }

    public function createTodoItem(array $attributes)
    {
        return $this->todoRepository->createTodoItem($attributes);
    }

    public function updateTodoItem($id, array $attributes)
    {
        return $this->todoRepository->updateTodoItem($id, $attributes);
    }

    public function deleteTodoItem($id)
    {
        return $this->todoRepository->deleteTodoItem($id);
    }

    public function getDeletedTodoItems()
    {
        return $this->todoRepository->getDeletedTodoItems();
    }

    public function restoryDeletedTodoItem($id)
    {
        return $this->todoRepository->restoryDeletedTodoItem($id);
    }
    
    public function getDeadline()
    {
        return $this->todoRepository->getDeadline();
    }
}
