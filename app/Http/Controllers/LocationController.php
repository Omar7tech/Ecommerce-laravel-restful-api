<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'street' => "required",
            'building' => 'required',
            'area' => 'required'
        ]);
        Location::create([
            'street' => $request->street,
            'building' => $request->building,
            'area' => $request->street,
            "user_id" => Auth::id()
        ]);
        return response()->json("Location added", 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'street' => "required",
            'building' => 'required',
            'area' => 'required'
        ]);
        $location = Location::find($id);
        $location->street = $request->street;
        $location->building = $request->building;
        $location->area = $request->area;
        $location->save();
    }
    public function destroy($id)
    {
        $location = Location::find($id);
        if ($location) {
            $location->delete();
            return response()->json("Location has been deleted ! ", 201);
        }
        return response()->json("location not found");
    }
}


