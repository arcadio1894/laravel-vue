<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Product::create(['name'=>'platano','descripcion' => 'Platano unidad','precio'=>'1.00', 'habilitado' => 1]);
      Product::create(['name'=>'manzana','descripcion' => 'Manzana unidad','precio'=>'1.00', 'habilitado' => 1]);
      Product::create(['name'=>'Coca-Cola 3L','descripcion' => 'Gaseosa coca-cola de 3L','precio'=>'10.00', 'habilitado' => 1]);
      Product::create(['name'=>'Fanta 3L','descripcion' => 'Gaseosa fanta de 3L','precio'=>'10.00', 'habilitado' => 1]);
      Product::create(['name'=>'Sprite 2.25L','descripcion' => 'Gaseosa sprite de 2.25L','precio'=>'9.00', 'habilitado' => 1]);
      Product::create(['name'=>'Kola escocesa 1.5L','descripcion' => 'Gaseosa kola escocesa de 1.5L','precio'=>'8.00', 'habilitado' => 1]);
    }
}
