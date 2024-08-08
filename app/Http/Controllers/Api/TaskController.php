<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by due_date
        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->input('due_date'));
        }

        return new TaskCollection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {

        // La validación se realiza automáticamente aquí gracias al StoreTaskRequest
        $validated = $request->validated();

        // Crear la tarea
        $task = Task::create($validated);

        // Devolver la tarea creada con el código 201
        return response()->json(TaskResource::make($task), 201);
    }


    public function show($task)
    {
        //busca la tarea por id
        $task = Task::find($task);

        //valida que la tarea exista
        if (is_null($task)) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        //devuelve la tarea solicitada
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $task->update($validated);
        //devuelve la tarea actualizada
        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $deleted = $task->delete();

        if ($deleted) {
            return response()->json(['message' => 'Tarea eliminada correctamente.'], 204);
        } else {
            return response()->json(['message' => 'Error al eliminar la tarea.'], 500);
        }
    }
}
