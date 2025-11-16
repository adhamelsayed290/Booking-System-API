<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => "Event-$this->id",
            "title" => $this->title,
            "description" => $this->description,
            "location" => $this->location,
            "date" => $this->date->format('D M Y'),
            "available_seats" => $this->available_seats,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
            "category" => new CategoryResource($this->category),
        ];
    }
}
