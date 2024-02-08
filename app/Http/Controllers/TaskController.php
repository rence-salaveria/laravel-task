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
        // * no custom error message for this since the get "/login" handles non-authorized users
        $this->authorize('viewAny', Task::class);
        $tasks = TaskResource::collection(
            Task::where('user_id', auth()->id())->get()
        );

        return $this->success($tasks, 'Tasks retrieved successfully');
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

        if (! auth()->user()->can('view', $task)) {
            return $this->error('You are unauthorized to view this task', 403);
        }

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

    public function destroy($id)
    {
        $this->authorize('delete', Task::findOrFail($id));
        Task::destroy($id);
    }
}
