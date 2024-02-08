<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponse;

class TaskController extends Controller
{
    use HttpResponse;

    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = TaskResource::collection(
            Task::where('user_id', auth()->id())->get()
        );

        return $this->success($tasks, 'Tasks retrieved successfully');
    }

    public function store(CreateTaskRequest $request)
    {
        $taskDetails = $request->validated();
        $taskDetails['user_id'] = auth()->id();
        $task = Task::create($taskDetails);

        return $this->success(new TaskResource($task), 'Task created successfully');
    }

    public function show($id)
    {
        $this->authorize('view', Task::find($id));
        $task = new TaskResource(Task::find($id));

        return $this->success($task, 'Task retrieved successfully');
    }

    public function update(EditTaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->error('Task not found', 404);
        }

        $this->authorize('update', $task);

        $newTaskDetails = $request->validated();
        $task->update($newTaskDetails);

        return $this->success(new TaskResource($task), 'Task updated successfully');
    }

    public function destroy($id)
    {
    }
}
