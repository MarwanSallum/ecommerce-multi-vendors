<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use Translatable;

    
    protected $translatedAttributes = ['name'];

    protected $with = ['translations'];

    protected $fillable = ['parent_id', 'slug', 'is_active'];

    protected $hidden =['translations'];

    protected $casts =[
        'is_active' => 'boolean',
    ];


}
