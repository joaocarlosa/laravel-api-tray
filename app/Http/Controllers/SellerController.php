<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Requests\SellerRequest;
use App\Http\Resources\SellerResource;

class SellerController extends Controller
{

    public function index()
    {
        $sellers = Seller::all();
        return SellerResource::collection($sellers);
    }

    public function show($id)
    {
        $seller = Seller::findOrFail($id);
        return new SellerResource($seller);
    }


    public function store(SellerRequest $request)
    {
        $seller = Seller::create($request->validated());
        return new SellerResource($seller);
    }

    public function update(SellerRequest $request, Seller $seller)
    {
        $seller->update($request->validated());
        return new SellerResource($seller);
    }

    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
