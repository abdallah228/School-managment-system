<?php

namespace App\Http\Resources\Api\Dashboard\Grades;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
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
            'name'=> $this->getTranslation('name',app()->getLocale($request->lang)),
            'notes'=>$this->notes,
        ];
    }
   
}
