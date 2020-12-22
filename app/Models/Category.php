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

    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }

    public function scopeChild($query){
        return $query -> whereNotNull('parent_id');
    }

    public function _parent(){
        return $this ->belongsTo(self::class, 'parent_id');
    }

    public function _children(){
        return $this ->hasMany(self::class, 'parent_id');
    }

    public function getActive(){
       return $this -> is_active == 0 ? __('admin\dashboard.not_active') : __('admin\dashboard.active');
    }


}
