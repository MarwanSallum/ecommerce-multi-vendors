<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use Translatable;

    // هنا البكيج بتربط من خلال حقل الإسم من جدول الترجمة بشكل تلقائي
    protected $translatedAttributes = ['name'];

    protected $with = ['translations'];

    protected $fillable = ['parent_id', 'slug', 'is_active'];

    // تم إخفاء الترجمات من داخل المودل ويمكن إستدعائها من خلال الكونترولر بإستخدام 
    // makeVisible(['translations']);
    protected $hidden =['translations'];

    protected $casts =[
        'is_active' => 'boolean',
    ];


}
