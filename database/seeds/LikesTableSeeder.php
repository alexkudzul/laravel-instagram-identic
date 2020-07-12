<?php

use App\Like;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //limpia la tabla de la DB, si solo se ejecuta "php artisan db:seed", caso contrario se duplica cada insert
        Like::truncate();

        $like = new Like();
        $like->user_id = 1;
        $like->image_id = 4;
        $like->save();

        $like = new Like();
        $like->user_id = 2;
        $like->image_id = 1;
        $like->save();

        $like = new Like();
        $like->user_id = 1;
        $like->image_id = 2;
        $like->save();

        $like = new Like();
        $like->user_id = 2;
        $like->image_id = 3;
        $like->save();

        $like = new Like();
        $like->user_id = 1;
        $like->image_id = 4;
        $like->save();
    }
}
