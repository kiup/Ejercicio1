<?php

use Illuminate\Database\Seeder;
use App\Address;
use App\Label;
use App\Product;
use App\Review;
use App\Seller;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $numOfProducts = 3;
      $numOfSellers = 2;
      $numOfLabels = 5;
      $numOfReviews = 10;

      //se crean las etiquetas
      factory (\App\Label::class, $numOfLabels)->create();
      //se crean los vendedores
      factory(\App\Seller::class, $numOfSellers)->create();


      $sellers_id = App\Seller::all('id');

      for ($i=1; $i < $numOfSellers; $i++) {
        $seller_id = $sellers_id->get('id', $i);

        //se le asignan las direcciones a los vendedores
        factory(App\Address::class)->create(['seller_id' => $seller_id]);

        //se crean los productos para cada vendedor
        factory(App\Product::class, $numOfProducts)->create(['seller_id' => $seller_id])
        ->each(function ($product){
          $product->labels()->save(App\Label::all()->random());
        });
      }

      $products_id = App\Product::all('id');

      for ($i=1; $i < $products_id->count(); $i++) {
        //Se crean las reseñas para cada producto
        factory(App\Review::class, $numOfReviews)->create([
          'product_id' => $products_id->get('id', $i)
        ]);
      }
    }
}
