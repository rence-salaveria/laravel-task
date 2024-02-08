<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTaskRequest extends FormRequest
{
    public function rules(): array
    {
        /*
         * TODO: Validation rules for task_priority and task_status
         * currently not working as expected.
         *
         * OUTPUT: RETURNS 404
         * EXPECTED: RETURNS 422
         *
         * Probably an error from not parsing the enum values correctly
         * and the enum not throwing a `ValidationException`.
         */
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
