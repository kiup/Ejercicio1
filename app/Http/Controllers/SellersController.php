<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\StoreSellerRequest;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\PartialUpdateSellerRequest;
use Response;

class SellersController extends Controller
{
    public function index()
    {
      return Response::json(Seller::all());
    }

    public function show($seller)
    {
      $sellerInstance = Seller::findOrFail($seller);
      return $sellerInstance;
    }


    public function store(StoreSellerRequest $request)
    {
      $attributes = $request->all();//obtiene atributos
      $seller = Seller::create($attributes);//crea el vendedor
      return Response::json($seller);
    }

    public function total_update(StoreSellerRequest $request, Seller $seller)
    {
      $attributes = $request->all();
      $seller -> update($attributes);//actualiza la información
      return $seller;
    }

    public function partial_update(PartialUpdateSellerRequest $request, Seller $seller)
    {
      $attributes = $request->all();
      $seller -> update($attributes);//actualiza la información
      return $seller;
    }

    public function destroy(Seller $seller)
    {
      $seller->delete();
      return Response::json([],200);
    }

    public function store_address(Request $request, Seller $seller)
    {
      $attributes  = $request->all();
      $address = new Address($attributes);
      if($seller->address === null){
          $seller->address()->save($address);
      }
      else{
          $seller->address->update($attributes);
      }
      return Response::json($seller->address);
    }

    public function update_address(Request $request, Seller $seller)
    {
      $attributes  = $request->all();
      $address = $seller->address;
      $address->update($attributes);
      return Response::json($address);
    }
}
