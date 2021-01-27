<?php

namespace App\Http\Requests\Api\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest_api extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name_ar'=>'required',
            'name_en'=>'required',
            'notes'=>'nullable',
        ];
    }

        public function messages()
        {
            return [
            'name_ar.required'=>'ادخل الاسم',
            'name_en.required'=>'ادخل الاسم',
            ];

        }
  
}
