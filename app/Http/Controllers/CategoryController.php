<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(10);
        return response()->json($category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json($category, 200);
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
                'name' => "required|unique:categories,name"
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            \DB::commit();
            return response()->json(["error" => false, "data" => $category, "message" => "data added successfully"], 201);
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(["error" => true, "message" => "category not added , There is an error !"], 500);
        }
    }

    public function update_category($id, Request $request)
    {
        try {
            \DB::beginTransaction();
            $validated = $request->validate([
                'name' => "required|unique:brands,name"
            ]);
            $category = Category::where("id", $id)->upadate('name', $request->name);
            \DB::commit();
            return response()->json([
                "error" => false,
                "data" => $category,
                "message" => "data updated Successfully"
            ], 201);
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(["error" => true, "message" => "category not updated , There is an error !"], 500);
        }


    }
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        } else {
            return response()->json(["error" => true, "message" => "data not found to delete",]);
        }

    }
}
