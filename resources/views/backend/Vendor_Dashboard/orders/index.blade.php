@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('orders_trans.Orders') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('orders_trans.Orders') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('orders_trans.All_Orders') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('orders_trans.Orders') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<x-backend.alert type="info" />

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

       

        
                        @php
                            $groupedOrders = $orders->groupBy('cart_id');
                        @endphp

                        @foreach ($groupedOrders as $cartId => $ordersGroup)
						
						<table border='1' style="width:100%">
	<tr><td style="width:30%">رقم الطلب</td><td>{{ $ordersGroup[0]->id }}</td></tr>
	<tr><td>حالة الطلب</td><td>
		
		@if ($ordersGroup[0]->status == 'pending')
                                        <span class="badge badge-rounded badge-success p-2 mb-2">
                                            {{ trans('orders_trans.Pending') }}
                                        </span>
                                    @elseif($ordersGroup[0]->status == 'processing')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('orders_trans.Processing') }}
                                        </span>
                                    @elseif($ordersGroup[0]->status == 'delivering')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('orders_trans.Delivering') }}
                                        </span>
                                    @elseif($ordersGroup[0]->status == 'completed')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('orders_trans.Completed') }}
                                        </span>
                                    @elseif($ordersGroup[0]->status == 'cancelled')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('orders_trans.Cancelled') }}
                                        </span>
                                    @elseif($ordersGroup[0]->status == 'refunded')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('orders_trans.Refunded') }}
                                        </span>
                                    @endif
		</td></tr>
							
<tr><td>العميل</td><td>
	{{ $ordersGroup[0]->user->first_name }} {{ $ordersGroup[0]->user->last_name }}
	
	</td></tr>
							
	 @foreach ($ordersGroup[0]->products as $product)					
<tr><td colspan ="2">  
                                   
										<table border='1' style="width:100%">
											<tr><td style="width:30%">المنتج</td><td>{{ $product->order_item->product_name }} </td>
												<td rowspan="4" align='center' width="30%"> 
                                                    <img src="{{$product->image_url}}" 
                                                    style="max-height:100%;max-width:100%;"
                                                    alt="{{ $product->order_item->product_name }}"></td> </tr>
											<tr><td>الكمية</td><td> 
												  {{ $product->order_item->measure }} 
												</td></tr>
											<tr><td>الخصائص</td><td>
												@if(isset($product->order_item->color))
												اللون : {{ $product->order_item->color}}/
												@endif
											 
												@if(isset($product->order_item->size))
												القياس : {{ $product->order_item->size}}
												@endif
											 
												 

												</td></tr>
											<tr><td>السعر</td><td>
												{{Currency::format( $product->order_item->price-
												($product->order_item->price*$ordersGroup[0]->store->percent/100))}}
												<br>
												@php
                                        $totalPrice = 0;
                                    @endphp

                                    @foreach ($ordersGroup[0]->products as $product)
                                        @php
                                            $totalPrice += $product->price;
                                        @endphp
                                    @endforeach

                                    {{ Currency::format( $product->order_item->price) }}</td></tr>
	</table>
                                        
                                    @endforeach							
							
</td>
</tr>
</table>
@endforeach
             

 


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();

        $('#assign_delivery').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var orderId = button.data(
                'order-id'); // Extract the order ID from the button data attribute
            $('#order_id').val(orderId); // Set the value of the hidden input field with the order ID
        });
    });
</script>
@endpush