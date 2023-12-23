<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;

class AppController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $totalItems = count($items);

        $orders = Order::all();
        $totalOrders = count($orders);

        return view('index', compact('totalItems', 'totalOrders'));
    }
}
