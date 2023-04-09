<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Perangkat;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when(!is_null($request->get('perangkat_id')) , function($query) use($request) {
            $perangkat = Perangkat::find($request->get('perangkat_id'));

            $product_ids = [];
            if(!is_null($perangkat)) {
                $product_ids = $perangkat->perangkat_items->map(fn ($item) => $item->product_id)->toArray();
            }

            return $query->whereNotIn('id' , $product_ids);
        })
        ->when(!is_null($request->get('search')) , fn($query) =>  $query->where('name' , 'like' , '%' .$request->search . '%') )
        ->get();

        return ProductResource::collection($products);
    } 
}
