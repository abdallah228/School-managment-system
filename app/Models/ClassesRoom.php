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
    }
}
