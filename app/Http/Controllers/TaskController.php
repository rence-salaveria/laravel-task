<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponse;

class TaskController extends Controller
{
    use HttpResponse;

    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::where('user_id', auth()->id())->get();

        return $this->success(TaskResource::collection($tasks), 'Tasks retrieved successfully');
    }

    public function store(StoreTaskRequest $request)
    {
        $taskDetails = $request->validated();
        $taskDetails['user_id'] = auth()->id();
        $task = Task::create($taskDetails);

        return $this->success(new TaskResource($task), 'Task created successfully');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('view', $task);

        return $this->success(new TaskResource($task), 'Task retrieved successfully');
    }

    public function update(EditTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('update', $task);

        $newTaskDetails = $request->validated();
        $task->update($newTaskDetails);

        return $this->success(new TaskResource($task), 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return $this->success([], 'Task deleted successfully');
    }
}
