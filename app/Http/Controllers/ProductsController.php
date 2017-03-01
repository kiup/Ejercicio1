<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartialUpdateProductRequest;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use App\Label;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreReviewRequest;


class ProductsController extends Controller
{

  public function index()
  {
    return Response::json(Product::with('seller', 'label')->get());
  }

  public function show($product)
  {
    $productInstance = Product::findOrFail($product);
    return Response::json($productInstance->load('seller','label'));
  }

  public function store(StoreProductRequest $request)
  {
      $attributes = Input::only('name', 'price', 'description', 'seller_id');
      $product = Product::create($attributes);

      $labels = $request->input('label');

      foreach($labels as $label){
          if($new_label = Label::where('name', '=', $label)->firstOrCreate(array('name'=>$label))){
              $product->label()->save($new_label);
          }else{
              $product->labels()->save($new_label);
          }
      }
    return Response::json($product);
  }

  public function total_update(StoreProductRequest $request, Product $product)
  {
      $attributes = $request->all();
      $product -> update($attributes);//actualiza la información
      return $product;
  }

  public function partial_update(PartialUpdateProductRequest $request, Seller $seller)
  {
      $attributes = $request->all();
      $seller -> update($attributes);//actualiza la información
      return $seller;
  }

  public function destroy(Product $product)
  {
    $product->delete();
    return Response::json([],200);
  }

  public function show_reviews($product)
  {
      $productInstance = Product::findOrFail($product);
      return Response::json($productInstance->load('review'));
  }

  public function store_review(StoreReviewRequest $request, Product $product)
  {
    $attributes  = $request->all();
    $review = new Review($attributes);
    $product->review()->save($review);
    return Response::json($review);
  }

  public function destroy_review(Review $review)
  {
    $review->delete();
    return Response::json([],200);
  }
}
