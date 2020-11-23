<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScreeningResource extends JsonResource
{
    public function toArray($request)
    {
        if($this->viewers < $this->term->hall->capacity)
            $freeTickets = true;
        else 
            $freeTickets = false;
        
        return [
            'title' => $this->movie->title,
            'term' => $this->term->date_time,
            'time' => $this->movie->time,
            'freeTickets' =>  $freeTickets,
        ];
    }
}
