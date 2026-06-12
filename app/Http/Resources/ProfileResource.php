<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'class' => $this->schoolClass->name,
            'section' => $this->schoolClass->section,
            'phone' => $this->phone,
            'address' => $this->address,
            'average' => $average ,
            'attendance' => $this->attendanceSummary()['attendance_percentage'],
        ];
    }
}
