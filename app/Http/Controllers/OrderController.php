<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(20);
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order->items as $order_items) {
                    $product = Product::where('id', $order_items->product_id)->pluck("name");
                    $order_items->product_name = $product['0'];
                }
            }
            return response()->json(["data" => $order], 200);
        }
        return response()->json(["error" => true, "message" => "there is no orders"], );
    }

    public function show($id)
    {
        $order = Order::find($id);
        return response()->json($order, 200);
    }

    public function store(Request $request)
    {
        $location = Location::where("user_id", Auth::id())->first();

        $request->validate([
            'order_items' => 'required',
            'total_price' => 'required',
            'quantity' => 'required',
            'date_od_delivery' => 'required',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->location_id = $location->id;
        $order->total_price = $location->total_price;
        $order->date_of_delivery = $location->date_of_delivery;

        $order->save();

        foreach ($request->order_items as $order_item) {
            $items = new OrderItems();
            $items->order_id = $order->id;
            $items->price = $order_item['price'];
            $items->product_id = $order_item['product_id'];
            $items->quantity = $order_item['quantity'];
            $items->save();
            $product = Product::where('id', $order_item('product_id'))->first();
            $product->quantity = $order_item['quantity'];
            $product->save();
        }
        return response()->json('order is added , 201');
    }


    public function get_order_items($id)
    {
        $order_items = OrderItems::where('order_id', $id)->get();
        if ($order_items) {
            foreach ($order_items as $order_item) {
                $product = Product::where('id', $order_item->product_id)->pluck('name');
                $order_item->product_name = $product['0'];
            }
            return response()->json($order_items);
        } else {
            return response()->json('no items found');
        }
    }

    public function get_user_order ($id){
        $orders = Order :: where('user_id' , $id)::with('items' , function ($query){
            $query->orderBy('created_at' , 'desc');
        })->get();
        if($orders){
            foreach ($orders as $order) {
                $product = Product::where('id' , $order->product_id)->pluck('name');
                $order->product_name = $product['0'];
            }
            return response()->json($orders);
        }else{
            return response()->json('no orders found for this user');
        }
    }

    public function change_order_status($id , Request $request){
        $order = Order::find($id);
        if($order){
            $order->update(['status' => $request->status]);
            return response()->json('Status changed successfully !');
        }else{
            return response()->json('Order was not found');
        }
    }


}
