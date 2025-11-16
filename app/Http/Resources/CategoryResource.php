<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => "Category-$this->id",
            'title' => $this->name . '(: num of events: ' . $this->events()->count() . ')',
            'created_at' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at->diffForHumans(),
            'is_active'=>$this->is_active
        ];
    }
}
