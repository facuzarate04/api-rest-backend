<?php

namespace App\Http\Resources\Turn;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TurnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => ClientResource::make($this->whenLoaded('client')),
            'date' => $this->date,
            'duration' => $this->duration,
            'status' => $this->status,
        ];
    }
}
