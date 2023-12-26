<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderCreated;
use App\Exceptions\InvalidOrderException;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Destination;
use App\Models\Order;
use App\Models\OrderCoupon;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use App\Models\TempSession;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    //
    public function create(CartRepository $cart)
    {
        $user = Auth::user();
        $neighborhood_shipping = $user->neighborhood->price;
        $shipping_fees = 0;
        $storeIds = [];

        foreach ($cart->get() as $cart_item) {
            $store_id = $cart_item->product->store_id;

            if (!in_array($store_id, $storeIds)) {
                // If the store ID is not in the array, it's a unique store
                $storeIds[] = $store_id;
            }
        }
        // Now, $shipping_fees contains the total shipping fees based on the unique stores in the cart.

        $numberOfUniqueStores = count($storeIds);
        if($numberOfUniqueStores === 1) {
            $shipping_fees = $neighborhood_shipping;
        } else {
            $shipping_fees = (($numberOfUniqueStores - 1) * 5) + $neighborhood_shipping;
        }

        if ($cart->get()->count() == 0) {
            // return redirect()->route('home');
            throw new InvalidOrderException('Cart is Empty');
        }

        $destinations = Destination::all();
        $user = Auth::user();
        return view('frontend.pages.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames('ar'),
            'destinations' => $destinations,
            'user' => $user,
            'shipping_fees' => $shipping_fees
        ]);
    }

    public function getDestinationPrice($destinationId, CartRepository $cart)
    {

        $destination = Destination::find($destinationId);

        $neighborhood_shipping = $destination->price;
        $shipping_fees = 0;
        $storeIds = [];
        // $cart = json_decode(request()->input('cart'), true);


        foreach ($cart->get() as $cart_item) {
            $store_id = $cart_item->product->store_id;

            if (!in_array($store_id, $storeIds)) {
                // If the store ID is not in the array, it's a unique store
                $storeIds[] = $store_id;
            }
        }
        $numberOfUniqueStores = count($storeIds);
        if ($numberOfUniqueStores === 1) {
            $shipping_fees = $neighborhood_shipping;
        } else {
            $shipping_fees = ($numberOfUniqueStores - 1) * 5 + $neighborhood_shipping;
        }

        return response()->json(['price' => $shipping_fees]);
    }

    public function store(Request $request, CartRepository $cart)
    {

        // $request->validate([
        //     'phone_number'=>'required',
        // ]);

        // get items / products of the cart , treat each item as a cart , and group them by store
        $items = $cart->get()->groupBy('product.store_id');
        // get coupon stored in session , if it exist
        $coupon = Session::get('coupon');
        // get total price of products in cart
        $total = $cart->total();
        // if there is coupon stored in session
        if ($coupon) {
            // subtract coupon discount from total
            $total -= $coupon->discount_amount;
        }

        DB::beginTransaction();
        try {


            foreach ($items as $store_id => $cart_items) {


                $store = Store::findOrFail($store_id);
                $order = new Order();
                $order->store_id = $store_id;
                $order->user_id = Auth::user('user')->id;
                $order->payment_method = 'cash_on_delivery';
                $order->payment_status = 'pending';
                $order->status = 'pending';
                $order->total = $total;
                $order->shipping = $request->changed_shipping_fees ? $request->changed_shipping_fees : $request->shipping_fees;
                $order->coupon_id = $coupon ? $coupon->id : null;
                foreach ($cart_items as $item) {


                    // store order.cart_id
                    if($item->product->store->id == $store_id) {

                        $order->cart_id = $item->cookie_id;

                    }

                    if($item->product->measure == .10) {
                        $price =  $item->quantity * $item->product->price * $item->measure / 100;
                    } else {
                        $price =  $item->quantity * $item->product->price * $item->measure;
                    }

                    $order->store_order_total += $price;
                    $order->percent = ($store->percent * $price) / 100 ;
                    $order->save();

                    // dd($request->all(), $items, $order);


                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item->product_id,
                        'measure'       => $item->measure,
                        'size'          => $item->size ? $item->size : null,
                        'color'         => $item->color ? $item->color : null,
                        'product_name'  => $item->product->name,
                        'price'         => $price,
                        'quantity'      => $item->quantity,
                    ]);
                }

                if ($coupon) {
                    OrderCoupon::create([
                        'order_id' => $order->id,
                        'coupon_id' => $coupon->id,
                        'user_id' => Auth::user('user')->id
                    ]);

                    $temp_session = TempSession::where('user_id', Auth::user('user')->id)->first();
                    $temp_session->delete();
                }


                foreach ($request->post('address') as $type => $address) {

                    $address["type"] = $type;
                    $order->addresses()->create($address);
                }

                // Remove the coupon details from the session
                Session::forget('coupon');
                event(new OrderCreated($order));
            }



            DB::commit();

            Cart::regenerateCartSessionId();


        } catch (ValidationException $e) {
            // Handle validation errors
            // You can access the validation errors using $e->errors()
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Throwable $e) {

            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return redirect()->route('home');
    }

}
