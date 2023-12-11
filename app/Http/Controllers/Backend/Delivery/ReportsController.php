<?php

namespace App\Http\Controllers\Backend\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    //
    // get reports of auth delivery
    public function deliveryReport(){
        $deliveryUserId = Auth::user('delivery')->id;
        $deliveryOrders = OrderDelivery::where('delivery_id', $deliveryUserId)->with('order')->get();

        // Extract order_ids from the OrderDelivery collection
        $orderIds = $deliveryOrders->pluck('order_id');

        // Query orders based on the extracted order_ids
        $query = Order::whereIn('id', $orderIds)->where('status','<>','completed')->with('user', 'store');

          // Get the final result
        $orders = $query->get();

        return view('backend.Delivery_Dashboard.reports.delivery_reports', compact('orders','deliveryOrders'));

    }
}