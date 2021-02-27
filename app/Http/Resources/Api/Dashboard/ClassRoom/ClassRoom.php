<?php

namespace App\Http\Resources\Api\Dashboard\ClassRoom;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassRoom extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
        'name'=> $this->getTranslation('name',app()->getLocale($request->lang)),


       ];
    }
}
