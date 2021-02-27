<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
            'List_Classes.*.name_ar' => 'required',
            'List_Classes.*.name_en' => 'required',
        ];
    }//end function rules
    public function messages()
    {
        return [
                'List_Classes.*.name_ar.required'=>__('dashboard/classroom.class_room_name_ar.required'),
                //'List_Classes.*.name_ar.unique'=>__('dashboard/classroom.class_room_name_ar.unique'),
                'List_Classes.*.name_en.required'=>__('dashboard/classroom.class_room_name_en.required'),
                //'List_Classes.*.name_en.unique'=>__('dashboard/classroom.class_room_name_en.unique'),
        ];
    }//end function messages
}
