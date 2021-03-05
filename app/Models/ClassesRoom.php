<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class ClassesRoom extends Model
{
    //
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];//spatie translatable


    //.....relations.....
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }//end relation between grades && classesrooms

    public function sections()
        {
            return $this->hasMany('Ap\Models\Section','classes_id');
        }//end relation between sections && classesrooms
    
}
