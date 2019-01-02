<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;
        // 获取除了id为1之外的所有用户
        $followers = $users->slice(1);
        $followerIds = $followers->pluck('id')->toArray();
        // 关注除了1之外的所有用户
        $user->follow($followerIds);
        // 除id为1外的用户都关注
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
