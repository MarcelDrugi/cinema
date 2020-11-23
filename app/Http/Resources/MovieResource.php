<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'published' => $this->published,
            'time' => $this->time,
            'age_limit' => $this->age_limit,
            'poster' => $this->poster,
        ];
    }
}
