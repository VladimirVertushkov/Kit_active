<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'salary'=>$this->salary,
            'inventory_number'=>$this->inventory_number,
            'serial_number'=>$this->serial_number,
            'storage_id'=>$this->storage_id,
            'created_at'=>$this->created_at,
            'id_customer'=>$this->customer_id,
        ];
    }
}
