<?php

use Illuminate\Database\Seeder;
use function GuzzleHttp\Promise\each;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取faker实例
        $faker=app(Faker\Generator::class);
        //获取头像假数据
        $avatars=[
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        $users=factory(User::class)    //根据指定的 User 生成模型工厂构造器，对应加载 UserFactory.php 中的工厂设置。
                        ->times(10)    //指定生成模型的数量，此处我们只需要生成 10 个用户数据
                        ->make()       //方法会将结果生成为 集合对象。
                        ->each(function($user,$index)
                            use($faker,$avatars)
            {
                $user->avatar=$faker->randomElement($avatars);
            }//each是 集合对象 提供的 方法，用来迭代集合中的内容并将其传递到回调函数中
            //use 是 PHP 中匿名函数提供的本地变量传递机制，匿名函数中必须通过 use 声明的引用，才能使用本地变量


        );

        $user_array=$users->makeVisible(['password','remember_token'])->toArray();//makeVisible() 是 Eloquent 对象提供的方法，可以显示 User 模型 $hidden 属性里指定隐藏的字段，此操作确保入库时数据库不会报错。

        User::insert($user_array);
        $user=User::find(1);
        $user->name='青';
        $user->assignRole('Founder');
        $user->email='980399260@qq.com';
        $user->password=bcrypt('123456');
        $user->save();
        $user1 = User::find(2);
        $user1->assignRole('Maintainer');
        $user1->save();
    }
}
