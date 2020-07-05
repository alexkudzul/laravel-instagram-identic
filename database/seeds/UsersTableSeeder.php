<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Storage busca el disco public(configuracion de filesystems) y elimina el directorio users
        Storage::disk('users')->deleteDirectory('users');

        //limpia la tabla de la DB, si solo se ejecuta "php artisan db:seed", caso contrario se duplica cada insert
        User::truncate();

        $user = new User();
        $user->role = "user";
        $user->name = "Alex";
        $user->lastname = "Ku Dzul";
        $user->nickname = "aleks";
        $user->email = "alex@alex.com";
        $user->password = bcrypt(123);
        $user->save();

        $user = new User();
        $user->role = "user";
        $user->name = "Manuel";
        $user->lastname = "Ku Dzul";
        $user->nickname = "manuels";
        $user->email = "manuel@manuel.com";
        $user->password = bcrypt(123);
        $user->save();
    }
}
