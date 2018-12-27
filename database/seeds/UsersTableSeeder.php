<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // 用factory()辅助函数生成50个用于填充的模型
        $user = factory(User::class)->times(50)->make();
        // 在模型中插入数据
        User::insert($user->makeVisible(['password', 'remember_token'])->toArray());
        $user = User::find(1);
        $user->name = 'zhangsan';
        $user->email = 'zhangsan@qq.com';
        $user->is_admin = true;
        $user->save();
    }

}
