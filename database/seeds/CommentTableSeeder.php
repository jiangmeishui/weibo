<?php

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = [1, 2, 3];
        $goodsId = [4, 5, 6];
        $fake = app(Faker\Generator::class);
        $comment = factory(Comment::class, 50)->make()->each(function ($v) use ($userId, $goodsId, $fake) {
            $v->user_id = $fake->randomElement($userId);
            $v->goods_id = $fake->randomElement($goodsId);
        });
        Comment::insert($comment->toArray());
    }
}
