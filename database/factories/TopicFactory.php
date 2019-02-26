<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    //随机生成小段落
    $sentence=$faker->sentence();
    //随机生成一个月内的时间---更新时间
    $updated_at=$faker->dateTimeThisMonth();
    //随机生成一个月以内的时间，但是不能超过更新时间，因为创建时间肯定比更新时间要早---创建时间
    $created_at=$faker->dateTimeThisMonth($updated_at);


    return [
        'title'=>$sentence,
        'body'=>$faker->text(),//随机生成大段落文本 --内容
        'excerpt'=>$faker->text(),//摘录字段
        'updated_at'=>$updated_at,
        'created_at'=>$created_at,
    ];
});
