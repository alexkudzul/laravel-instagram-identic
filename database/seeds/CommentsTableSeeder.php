<?php

use App\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //limpia la tabla de la DB, si solo se ejecuta "php artisan db:seed", caso contrario se duplica cada insert
        Comment::truncate();

        $comment = new Comment();
        $comment->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $comment->user_id = 1;
        $comment->image_id= 1;
        $comment->save();

        $comment = new Comment();
        $comment->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $comment->user_id = 1;
        $comment->image_id= 2;
        $comment->save();

        $comment = new Comment();
        $comment->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $comment->user_id = 2;
        $comment->image_id= 3;
        $comment->save();

        $comment = new Comment();
        $comment->content = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $comment->user_id = 2;
        $comment->image_id= 4;
        $comment->save();
    }
}
