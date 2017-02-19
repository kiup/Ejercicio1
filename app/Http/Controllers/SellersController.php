<?php

namespace App\Http\Controllers;
use App\Seller;
use Illuminate\Http\Request;
use Response;

class SellersController extends Controller
{
    public function index()
    {
      return Response::json(Seller:all());
    }

    public function show(Seller $seller)
    {
      return $seller;
    }

    public function store(Request $request)
    {
      $attributes = $request->all();//obtiene atributos
      $seller = Seller::create($attributes);//crea el vendedor
      return Response::json($seller);
    }

    public function update(Request $request, Seller $seller)
    {
      $attributes = $request->all();
      $seller->update($attributes);//actualiza la información
      return $seller;
    }

    public function destroy(Seller $seller)
    {
      $seller->delete();
      return Response::json([],200);
    }
}
