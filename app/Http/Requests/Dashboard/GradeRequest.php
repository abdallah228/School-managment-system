<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'name_ar'=>'required|unique:grades,name->ar,'.$this->id,
            'name_en'=>'required|unique:grades,name->en,'.$this->id,
            
        ];
    }
    public function messages()
    {
        return [

            'name_ar.required'=>__('dashboard/grade.grade_name_ar'),
            'name_ar.unique'=>__('dashboard/grade.grade_name_ar_unique'),
            'name_en.required'=>__('dashboard/grade.grade_name_en'),
            'name_en.unique'=>__('dashboard/grade.grade_name_en_unique'),


        ];
        
    }
}
