<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task_name' => ['required'],
            'task_description' => ['required'],
            'task_priority' => [
                'required',
                new Enum(TaskPriority::class),
            ],
            'task_status' => ['required',
                new Enum(TaskStatus::class), ],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
