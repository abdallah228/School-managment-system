<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    //
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];//spatie translatable

    // protected $casts = [
    //   'status'=>'boolean',  
    // ];//end casts
    protected $casts = [ // to return true or false not 0 or 1
        'status'=>'boolean',
      ];
    //////////global function/////
    public function get_status()
     {
         return $this->status == 1 ? '<label class="badge badge-success">'. __("dashboard/sections.status_true"). '</label>': '<label class="badge badge-danger">'. trans("dashboard/sections.status_false").'</label>' ;
    }//end function




    ////end global function////



    public function classes_rooms()
    {
        return $this->belongsTo('App\Models\ClassesRoom','classes_id');
    }//end relation between sections && classesroom

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }//end relaion between sections and grades

}//end class
