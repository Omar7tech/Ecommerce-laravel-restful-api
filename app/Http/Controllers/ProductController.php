<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        if ($products) {
            return response()->json($products, 200);
        } else {
            return response()->json("no products available");
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product, 200);

        } else {
            return response()->json(["error" => true, "message" => "nothing to show"]);
        }
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            //make your own validations here , omar7tech
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->discount = $request->discount;
        $product->amount = $request->amount;
        //handle image upload
        $product->save();
        return response()->json("data added successfully");
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            //make your own validations here , omar7tech
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->discount = $request->discount;
        $product->amount = $request->amount;
        //handle image upload
        $product->save();
        return response()->json("data added successfully");
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json("product has been deleted ! ", 201);
        }
        return response()->json("product not found");
    }
}
