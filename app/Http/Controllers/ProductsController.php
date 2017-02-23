<?php

namespace App\Http\Controllers;

use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Response;
use App\Label;
use App\Http\Requests\ProductRequest;


class ProductsController extends Controller
{

public function index_label()
{
  return Response::json(Label::all());
}

  public function index()
  {
    $array_product = Product::all();
    $array_total = array();
    foreach ($array_product as $i => $product) {
      $array_for_product = array();
      $array_for_product[] = $product;
      $array_for_product[] = $product->seller;
      $array_for_product[] = $product->label;

      $array_total[] = $array_for_product;
    }
    return Response::json($array_total);
  }

  public function show($product)
  {
    $productInstance = Product::findOrFail($product);

    $array_for_product = array();
    $array_for_product[] = $productInstance;
    $array_for_product[] = $productInstance->seller;
    $array_for_product[] = $productInstance->label;

    return Response::json($array_for_product);
  }

  public function store(ProductRequest $request, Seller $seller)
  {
    $attributes  = $request->all();
    $product = new Product($attributes);
    $seller->product()->save($product);
    return Response::json($product);
  }

  public function update(Request $request, Product $product)
  {
    $attributes = $request->all();
    $product -> update($attributes);//actualiza la información
    return $product;
  }

  public function destroy(Product $product)
  {
    $product->delete();
    return Response::json([],200);
  }

  public function store_review(Request $request, Product $product)
  {
    $attributes  = $request->all();
    $review = new Review($attributes);
    $product->review()->save($review);
    return Response::json($review);
  }

  public function index_review(Product $product)
  {
    $reviews = $product->review->all();
    return Response::json($reviews);
  }

  public function destroy_review(Request $request, Product $product, Review $review)
  {
    $review->delete();
    return Response::json([],200);
  }
}
