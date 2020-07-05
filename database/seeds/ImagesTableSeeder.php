<?php

use App\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Storage busca el disco public(configuracion de filesystems) y elimina el directorio images
        Storage::disk('images')->deleteDirectory('images');

        //limpia la tabla de la DB, si solo se ejecuta "php artisan db:seed", caso contrario se duplica cada insert
        Image::truncate();

        $image = new Image();
        $image->image_path = "image1.jpg";
        $image->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $image->user_id = 1;
        $image->save();

        $image = new Image();
        $image->image_path = "image2.jpg";
        $image->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $image->user_id = 2;
        $image->save();

        $image = new Image();
        $image->image_path = "image3.jpg";
        $image->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $image->user_id = 1;
        $image->save();

        $image = new Image();
        $image->image_path = "image4.jpg";
        $image->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
        $image->user_id = 2;
        $image->save();
    }
}
