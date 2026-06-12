<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parent = auth()->user();
        $average = $this->marks()->avg('score');
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'parent_email' => $this->parent_email,
            'code' => $this->code,
            'parent_name' => $parent->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'stats' => [
            'attendance' => $this->attendanceSummary()['attendance_percentage'],
            'average' => $average ,
            'behavior' => 80,
        ],
        'notifications' => NotificationResource::collection($this->notifications()->latest()->get()),
        ];
    }
}
