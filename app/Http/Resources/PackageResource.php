<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->package_name,
            'amount' => $this->package_amount,
//            'description' => $this->package_description,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ];
    }
}
