<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // NOTA: La deshabilitación de la revisión de llaves foranes es solo para DESARROLLO, NO PARA PRODUCCION

        // Si se muestra un error de que no se puede truncate una tabla haciendo referencia a una llave foranea
        // antes de ejecutar los seeders, deshabilitamos la revision de las llaves forraneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $this->call(UserSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LikesTableSeeder::class);

        // cuando se ejecute los seeders, que se active de nuevo
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
