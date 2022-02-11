<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\API\TodoCreateRequest;
use App\Http\Requests\API\TodoGetRequest;
use App\Http\Requests\API\TodoUpdateRequest;
use App\Http\Requests\API\TodoDeleteRequest;
use App\Http\Controllers\AppBaseController;
use App\Services\TodoService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TodoItemsExport;

class TodoItemController extends AppBaseController
{
    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodoItems(TodoGetRequest $request)
    {
        $name = $request->name;
        $finish = $request->finish;
        $size = $request->size;

        return response()->json(
            ['todos' => $this->todoService->getTodoItems($name, $finish, $size)],
            200
        )->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTodoItem(TodoCreateRequest $request)
    {
        $todo = $this->todoService->createTodoItem([
            'name' => $request->name,
            'level' => $request->level,
            'deadline' => $request->deadline,
            'content' => $request->content,
            'user_name' => $request->user_name,
            'is_top' => $request->is_top,
            'finish' => $request->finish
        ]);

        return response()->json([
            'todo' => $todo
        ], 200)->header('Content-Type', 'application/json');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTodoItem(TodoUpdateRequest $request)
    {
        $this->todoService->updateTodoItem(
            $request->id,
            [
                'name' => $request->name,
                'level' => $request->level,
                'deadline' => $request->deadline,
                'finish' => $request->finish,
                'content' => $request->content,
                'is_top' => $request->is_top
            ],
        );


        return response()->json([
            'status' => 'success'
        ], 200)->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTodoItem(TodoDeleteRequest $request)
    {
        $this->todoService->deleteTodoItem($request->id);
        return response()->json([
            'status' => 'success'
        ], 200)->header('Content-Type', 'application/json');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDeletedTodoItems()
    {
        $todos = $this->todoService->getDeletedTodoItems();
        return response()->json(
            $todos,
            200
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoryDeletedTodoItem(TodoDeleteRequest $request)
    {
        $todos = $this->todoService->restoryDeletedTodoItem($request->id);
        return response()->json(
            [
                'todos' => $todos,
                'message' => 'success'
            ],
            200
        );
    }

    public function exportExcel() 
    {
        return Excel::download(new TodoItemsExport, 'todos.xlsx');
    }
}
