<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
        return response()->json($brands);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return response()->json($brand, 200);
        }
        return response()->json('brand not found');
    }

    public function store(Request $request)
    {


        /* $validated = $request->validate([
            'name' => "required|unique:brands,name"
        ]); */
        try {
            \DB::beginTransaction();
            $validator = Validator::make(request()->all(), [
                'name' => "required|unique:brands,name"
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }


            $brand = new Brand();
            $brand->name = $request->name;
            $brand->save();
            \DB::commit();
            return response()->json(["error" => false, "data" => $brand, "message" => "data added successfully"], 201);
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(["error" => true, "message" => "Brand not added , There is an error !"], 500);
        }
    }

    public function update_brand($id, Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => "required|unique:brands,name,".$id
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {


            \DB::beginTransaction();
            $brand = Brand::where("id", $id)->update(['name' => $request->name]);
            \DB::commit();
            return response()->json([
                "error" => false,
                "data" => $brand,
                "message" => "data updated Successfully"
            ], 201);
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(["error" => true, "message" => "Brand not updated , There is an error !"], 500);
        }


    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $brand->delete();
            return response()->json("data deleted successfully" , 201);
        } else {
            return response()->json(["error" => true, "message" => "data not found to delete",]);
        }
    }
}
