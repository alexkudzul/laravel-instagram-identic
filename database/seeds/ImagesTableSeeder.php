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
        Storage::disk('public')->deleteDirectory('images');

        //limpia la tabla de la DB, si solo se ejecuta "php artisan db:seed", caso contrario se duplica cada insert
        Image::truncate();

        $image = new Image();
        $image->image_path = "images/image1.jpg";
        $image->description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum vitae vel sequi eveniet ad quod quia id dolorem quasi laudantium voluptatum asperiores, veniam deserunt iusto placeat tenetur deleniti explicabo.";
        $image->user_id = 1;
        $image->save();

        $image = new Image();
        $image->image_path = "images/image2.jpg";
        $image->description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum vitae vel sequi eveniet ad quod quia id dolorem quasi laudantium voluptatum asperiores, veniam deserunt iusto placeat tenetur deleniti explicabo.";
        $image->user_id = 2;
        $image->save();

        $image = new Image();
        $image->image_path = "images/image3.jpg";
        $image->description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum vitae vel sequi eveniet ad quod quia id dolorem quasi laudantium voluptatum asperiores, veniam deserunt iusto placeat tenetur deleniti explicabo.";
        $image->user_id = 2;
        $image->save();

        $image = new Image();
        $image->image_path = "images/image4.jpg";
        $image->description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum vitae vel sequi eveniet ad quod quia id dolorem quasi laudantium voluptatum asperiores, veniam deserunt iusto placeat tenetur deleniti explicabo.";
        $image->user_id = 1;
        $image->save();
    }
}
