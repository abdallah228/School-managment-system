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



}