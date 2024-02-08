<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task_info' => [
                'task_name' => $this->task_name,
                'task_description' => $this->task_description,
                'task_priority' => [
                    'value' => $this->task_priority,
                    'description' => $this->task_priority->name,
                ],
                'task_status' => [
                    'value' => $this->task_status,
                    'description' => $this->task_status->name,
                ],
                'owner' => [
                    'user_id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
