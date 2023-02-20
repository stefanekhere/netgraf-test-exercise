<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request){
        Order::create([
            'id' => $request->id,
            'petId' => $request->petId,
            'quantity' => $request->quantity,
            'shipDate' => $request->shipDate,
            'status' => $request->status,
            'complete' => $request->complete,
        ]);
        return response()->json('Successful operation', 200, 'Success');
    }

    public function findOrderById($orderId){
        return Order::where('id', $orderId)->first();
    }

    public function delete($orderId){
        Order::where('id', $orderId)->first()->forceDelete();
        return response()->json('Successful operation', 200, 'Success');
    }

    public function getInventory(){

        $placed = Order::where('status', 'placed')->count();
        $approved = Order::where('status', 'approved')->count();
        $delivered = Order::where('status', 'delivered')->count();

        return [
            'placed' => $placed,
            'approved' => $approved,
            'delivered' => $delivered,
        ];
    }
}
