<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function order()
    {
        $items = Item::all();
        return view('order', compact('items'));
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'status' => 'required|in:selesai,menunggu pembayaran',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.item_id' => 'required|exists:items,id',
        ]);

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $itemData = Item::findOrFail($item['item_id']);
            $totalPrice += $itemData->harga * $item['quantity'];
        }

        $totalPriceWithTax = $totalPrice * 1.11;

        $order = Order::create([
            'status' => $request->status,
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
            ]);

            $itemData = Item::findOrFail($item['item_id']);
            $itemData->stok -= $item['quantity'];
            $itemData->save();
        }

        return redirect()->route('app.index')->with('success', 'Order created successfully.');
    }
}
