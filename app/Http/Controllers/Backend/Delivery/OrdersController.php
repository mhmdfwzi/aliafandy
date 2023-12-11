<?php

namespace App\Http\Controllers\Backend\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    //
    // function to get all orders of the auth delivery
    public function index()
    {
        $order_delivery = OrderDelivery::where('delivery_id', Auth::user('delivery')->id)->pluck('order_id');
        $orders = Order::whereIn('id', $order_delivery)->get();
        return view('backend.Delivery_Dashboard.orders.allOrders', compact('orders'));
    }

    // function to get not Completed orders of the auth delivery tp control them
    public function notCompletedOrders()
    {
        $order_delivery = OrderDelivery::where('delivery_id', Auth::user('delivery')->id)->pluck('order_id');
        $orders = Order::whereIn('id', $order_delivery)->where('status')->get();
        return view('backend.Delivery_Dashboard.orders.notCompletedOrders', compact('orders'));
    }

    // function change status of order
    public function changeStatus($order_id , $status){
        
        // 'pending','processing','delivering','completed','cancelled','refunded'
        $order = Order::find($order_id);

        if($status == "pending"){            
                $order->status = "processing";
        }
        elseif($status == "processing"){
            $order->status = "delivering";
        }
        elseif($status == "delivering"){
            $order->status = "completed";
        }
        $order->save();

        return redirect()->route('delivery.orders.index')->with('toast_success','order status changed successfully');
        
    }

    public function changeOrdersStatusToComplete($cart_id, $status) {
        try {
            // 'pending','processing','delivering','completed','cancelled','refunded'
            $orders = Order::where('cart_id', $cart_id)->get();
    
            DB::beginTransaction();
    
            foreach ($orders as $order) {
                $order->status = $status; // Use $status instead of hardcoding "completed"
                $order->save();
    
                $orderDelivery = OrderDelivery::where('order_id', $order->id)->first();
                if ($orderDelivery) {
                    $orderDelivery->order_delivery_time = now();
                    $orderDelivery->order_status = 'completed';
                    $orderDelivery->save();
                }
            }
    
            DB::commit();
    
            return redirect()->route('delivery.orders.index')->with('toast_success', 'Order status changed successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('delivery.orders.index')->with('toast_error', 'Error updating order status');
        }
    }

    public function orderReports($status = null)
    {
        //
        // $deliveries = Delivery::all();
        // $delivery = OrderDelivery::where('delivery_id',Auth::user('delivery')->id)->get();
        // $orders = Order::whereIn('id',$delivery->order_id)->with('user', 'store', 'products.category')->get();

        // if ($status != null) {
        //     $orders = Order::where('status', $status)->with('user', 'store', 'products.category')->get();
        // }

        $deliveryUserId = Auth::user('delivery')->id;
        $delivery = OrderDelivery::where('delivery_id', $deliveryUserId)->get();

        // Extract order_ids from the OrderDelivery collection
        $orderIds = $delivery->pluck('order_id');

        // Query orders based on the extracted order_ids
        $query = Order::whereIn('id', $orderIds)->with('user', 'store', 'products.category');

        // Optionally filter by status
        if ($status !== null) {
            $query->where('status', $status);
        }

        // Get the final result
        $orders = $query->get();



        return view('backend.Delivery_Dashboard.orders.orders_report', compact('orders', 'status'));
    }


    // get orders that have been delivered with that user
    public function deliveredOrdersReport(){
        $deliveryUserId = Auth::user('delivery')->id;
        $deliveryOrders = OrderDelivery::where('delivery_id', $deliveryUserId)->with('order')->get();

        // Extract order_ids from the OrderDelivery collection
        $orderIds = $deliveryOrders->pluck('order_id');

        // Query orders based on the extracted order_ids
        $query = Order::whereIn('id', $orderIds)->where('status','completed')->with('user', 'store');

          // Get the final result
        $orders = $query->get();

        return view('backend.Delivery_Dashboard.reports.delivered_orders', compact('orders','deliveryOrders'));

    }

   

    
}