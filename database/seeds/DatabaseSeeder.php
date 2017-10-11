<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CargueBasico::class);
        $this->call(CargueDemostracion::class);
        $this->call(CargueClientesOAUTH::class);
        $this->call(CargueUsuarios::class);

        #php artisan migrate:reset && php artisan migrate && php artisan db:seed
    }
}
