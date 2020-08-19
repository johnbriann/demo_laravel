<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Team extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }
    public function toArray($request)
    {
        return [
            'tm_id' => $this->tm_id,
            'tm_name' => $this->tm_name,
            'tm_slug' => $this->tm_slug,
            'tm_status' => $this->tm_status
        ];
    }
}
