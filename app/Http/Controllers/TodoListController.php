<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoListController extends Controller
{   
    use HttpResponseTrait;
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        $todo_list = new TodoList;
        $todo_list->title = $request->title;
        $todo_list->description = $request->description;
        $todo_list->note = $request->note;

        if ($todo_list->save()) {
            return $this->successResponse([
                'success' => true,
                'status'=> 'success',
                'data' => $todo_list,
            ], 'saved successfully!');
        }
        
        return $this->errorResponse('saving faild!');
    }

    /**
     * Summary of show
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TodoList $todoList): JsonResponse
    {
        $list = $todoList::all();
        return $this->successResponse([
            'success' => true,
            'status'=> 'success',
            'data' => $list,
        ], 'todos shown successfully!');
    }

    
    /**
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, TodoList $todoList): JsonResponse
    {
        try {
            $todo = $todoList::findOrFail($request->id);
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->note = $request->note;

            if ($todo->save()) {
                return $this->successResponse([
                    'success' => true,
                    'status'=> 'success',
                    'data' => $todo,
                ], 'updated successfully!');
            }
            
            return $this->errorResponse('update failed!');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse($e->getMessage());
        }
    }

   
    /**
     * Summary of delete
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, TodoList $todoList) : JsonResponse
    {
        try {
            $todo = $todoList::findOrFail($request->id);

            if ($todo->delete()) {
                return $this->successResponse([
                    'success' => true,
                    'status'=> 'success',
                ], 'deleted successfully!');
            }
            
            return $this->errorResponse('deletion failed!');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse($e->getMessage());
        }
    }
}
