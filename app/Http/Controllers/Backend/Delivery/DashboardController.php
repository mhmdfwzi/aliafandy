<?php

namespace App\Http\Controllers\Backend\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $deliveryUserId = auth('delivery')->user()->id;
        $deliveryOrders = OrderDelivery::where('delivery_id', $deliveryUserId)->with('order')->get();
    
        // Extract order_ids from the OrderDelivery collection
        $orderIds = $deliveryOrders->pluck('order_id');
    
        // Get the final result
        $pendingOrdersCount = Order::whereIn('id', $orderIds)->where('status', 'pending')->count();
        $completedOrdersCount = Order::whereIn('id', $orderIds)->where('status', 'completed')->count();
        $allOrdersCount = Order::whereIn('id', $orderIds)->count();

        return view('backend.Delivery_Dashboard.dashboard.index',compact('pendingOrdersCount','completedOrdersCount','allOrdersCount'));
    }
}