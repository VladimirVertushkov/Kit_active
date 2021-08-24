<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'salary'=>$this->salary,
            'inventory number'=>$this->inventory_number,
            'serial number'=>$this->serial_number,
            'registration date'=>$this->created_at,
        ];
    }
}
