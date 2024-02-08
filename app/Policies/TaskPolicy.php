<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        return $this->userOwnsTask($user, $task);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $this->userOwnsTask($user, $task);
    }

    public function delete(User $user, Task $task): bool
    {
        return $this->userOwnsTask($user, $task);
    }

    private function userOwnsTask(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
