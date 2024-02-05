<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        return response()->json($order);
    }

    public function store(Request $request)
    {
        // No validation for simplicity, please add validation based on your requirements
        $order = new Order();
        $order->menu_makanan = $request->input('menu_makanan');
        $order->jumlah = $request->input('jumlah');
        $order->total_harga_dalam_lumen = $request->input('total_harga_dalam_lumen');
        $order->id_pelanggan = $request->input('id_pelanggan');
        $order->save();

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        // You can keep the validation logic here if needed
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        $order->delete();
        return response()->json(null, 204);
    }
}
