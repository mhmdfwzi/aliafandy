<?php

namespace App\Http\Controllers\Backend\Delivery;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    //
    // get reports of auth delivery
    public function deliveryReport($date = null)
    {

        $deliveryUserId = Auth::user('delivery')->id;

        // Determine the date based on the provided parameter or use today's date
        $currentDate = $date ? Carbon::parse($date) : Carbon::now();
        // $currentDate = now()->today();

        // dd($currentDate);
        // Get orders for the current date
        $deliveryOrders = OrderDelivery::where('delivery_id', $deliveryUserId)
            ->whereDate('created_at', $currentDate)
            ->with('order')
            ->get();

        // Extract order_ids from the OrderDelivery collection
        $orderIds = $deliveryOrders->pluck('order_id');

        // Query orders based on the extracted order_ids
        $query = Order::whereIn('id', $orderIds)->where('status', 'completed')->with('user', 'store');

        // Get the final result with pagination
        $orders = $query->paginate(10);

        // Calculate previous and next day URLs for pagination links
        $prevDate = $currentDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $currentDate->copy()->addDay()->format('Y-m-d');
        $today = now()->format('Y-m-d');

        return view(
            'backend.Delivery_Dashboard.reports.delivery_reports',
            compact('orders', 'deliveryOrders', 'today', 'currentDate', 'prevDate', 'nextDate')
        );


    }

    // get reports of auth delivery
    public function adminReport($date = null)
    {



        // Determine the date based on the provided parameter or use today's date
        $currentDate = $date ? Carbon::parse($date) : Carbon::now();

        // Get orders for the current date
        $deliveryOrders = OrderDelivery::whereDate('order_delivery_time', $currentDate)
            ->with('order')
            ->get();


        // Extract order_ids from the OrderDelivery collection
        $orderIds = $deliveryOrders->pluck('order_id');

        // Query orders based on the extracted order_ids
        $query = Order::whereIn('id', $orderIds)->where('status', 'completed')->with('user', 'store');

        // Get the final result with pagination
        $orders = $query->paginate(10);



        // Calculate previous and next day URLs for pagination links
        $prevDate = $currentDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $currentDate->copy()->addDay()->format('Y-m-d');
        $today = now()->format('Y-m-d');

        return view(
            'backend.Delivery_Dashboard.reports.admin_reports',
            compact('orders', 'deliveryOrders', 'today', 'currentDate', 'prevDate', 'nextDate')
        );


    }

    public function adminFullReport($date = null)
    {


        // Determine the date based on the provided parameter or use today's date
        $currentDate = $date ? Carbon::parse($date) : Carbon::now();

        // Get orders for the current date
        // $deliveryOrders = OrderDelivery::whereDate('created_at', $currentDate)
        //     ->with('order')
        //     ->get();

        // // Extract order_ids from the OrderDelivery collection
        // $orderIds = $deliveryOrders->pluck('order_id');

        // // Query orders based on the extracted order_ids
        // $query = Order::whereIn('id', $orderIds)->where('status', 'completed')->with('user', 'store');

        // // Get the final result with pagination
        // $orders = $query->paginate(10);

        // Get deliveries for the current date with the count of orders
        $deliveries = OrderDelivery::whereDate('order_delivery_time', $currentDate)
        ->with('order') // Assuming you have a relationship named 'orders'
        ->withCount('order')
        ->get();

        // dd($deliveries);



        // Calculate previous and next day URLs for pagination links
        $prevDate = $currentDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $currentDate->copy()->addDay()->format('Y-m-d');
        $today = now()->format('Y-m-d');

        return view(
            'backend.Delivery_Dashboard.reports.admin_full_reports',
            compact('deliveries', 'today', 'currentDate', 'prevDate', 'nextDate')
        );
    }

    // get orders that have been delivered with that user
    //  public function deliveredOrdersReport()
    //  {
    //      $deliveryUserId = Auth::user('delivery')->id;
    //      $deliveryOrders = OrderDelivery::where('delivery_id', $deliveryUserId)->with('order')->get();

    //      // Extract order_ids from the OrderDelivery collection
    //      $orderIds = $deliveryOrders->pluck('order_id');

    //      // Query orders based on the extracted order_ids
    //      $query = Order::whereIn('id', $orderIds)->where('status', 'completed')->with('user', 'store');

    //      // Get the final result
    //      $orders = $query->get();

    //      return view('backend.Delivery_Dashboard.reports.delivered_orders', compact('orders', 'deliveryOrders'));

    //  }
}
