<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::all();
        return SaleResource::collection($sales);
    }

    public function store(SaleRequest $request)
    {
        $data = $request->validated();
        $data['commission'] = $data['value'] * 0.085;
        $sale = Sale::create($data);
        return new SaleResource($sale);
    }


    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return new SaleResource($sale);
    }

    public function update(SaleRequest $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $validated = $request->validated();
        $validated['commission'] = $validated['value'] * 0.085;
        $sale->update($validated);
        return new SaleResource($sale);
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    public function showBySeller($seller_id)
    {
        $sales = Sale::where('seller_id', $seller_id)->get();
        return SaleResource::collection($sales);
    }
}
