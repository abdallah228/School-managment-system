<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model 
{
    use HasTranslations;
    public $translatable = ['name'];//spatie translatable



    protected $guarded = [];
    protected $table = 'grades';
    public $timestamps = true;


 //.....relations.....
 public function classesrooms()
 {
     return $this->belongsTo('App\Models\ClassesRoom','grade_id');
 }//end relation between classesrooms && grades

 public function sections()
 {
     return $this->hasMany('App\Models\Section','grade_id');
 }//end relaion between sections and grades

}