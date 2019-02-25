<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[        //设置白名单哪些字段是支持修改的   'name','description'
        'name','description',
    ];
}
