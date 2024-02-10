<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EditTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task_name' => ['sometimes', 'required'],
            'task_description' => ['sometimes', 'required'],
            'task_priority' => [
                'sometimes',
                'required',
                new Enum(TaskPriority::class),
            ],
            'task_status' => [
                'sometimes',
                'required',
                new Enum(TaskStatus::class),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
