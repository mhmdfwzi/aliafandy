@extends('backend.layouts.master')

@section('title')
    {{ trans('orders_trans.Orders') }}
@endsection
@push('style')
    <style>
        /* Default styles for the table */
        .custom_table_1 {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .custom_table_1 th,
        .custom_table_1 td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .cutom_table_2 {
            display: none;
        }

        .modal2 {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 1060;
            display: none;
            overflow: hidden;
            outline: 0;
        }

        /* Responsive styles - hide columns on small screens */
        @media screen and (max-width: 600px) {
            .custom_table_1 {
                display: none
            }


            .cutom_table_2 {
                display: table;
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .cutom_table_2 th,
            .cutom_table_2 td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
        }
    </style>
@endpush
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
                    <table  width='100%' style="direction:rtl;background-color: #ddd" border='1' >
                        <tr>
                            <td>كود</td>
                            <td>{{ $cartId }}</td>
                        </tr>
                        <tr>
                            <td>وقت الطلب</td>
                            <td>{{ $ordersGroup[0]->user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>العميل</td>
                            <td>{{ $ordersGroup[0]->user->first_name }} -
                                {{ $ordersGroup[0]->user->phone_number }}
                                <br>
                                {{ $ordersGroup[0]->user->street_address }} ->
                                {{ $ordersGroup[0]->user->neighborhood->name }}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($ordersGroup as $additionalOrder0)
                                    @php

                                    @endphp

                                    @foreach ($additionalOrder0->products as $product)
                                        @php
                                            $totalPrice = $totalPrice + $product->order_item->price;
                                        @endphp
                                    @endforeach
                                @endforeach
                                
                                {{ Currency::format($totalPrice+$ordersGroup[0]->shipping) }}
 
                            </td>
                            <td>المطلوب من العميل</td>
                        </tr>
                        <tr>
                            <td>الحالة
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

                            </td>
                            <td>
                                @php
                                $order_delivery = App\Models\OrderDelivery::where('order_id', $ordersGroup[0]->id)->first();
                                $delivery = $order_delivery ? App\Models\Delivery::where('id', $order_delivery->delivery_id)->first() : null;
                            @endphp 
                                @can('assignDelivery', App\Models\Delivery::class)
                                    @if ($order_delivery)
                                        <div>{{ $delivery->name }} تم أرسال الطلب لمندوب الشحن</div>
                                    @else
                                        <button type="button" class="button x-small" data-toggle="modal"
                                            data-target="#assign_delivery"
                                            data-cart-id="{{ $ordersGroup[0]->cart_id }}"
                                            data-order-id="{{ $ordersGroup[0]->id }}">
                                            {{ trans('orders_trans.Assign_Delivery') }}
                                        </button>
                                    @endif
                                @endcan

                                



                                @php
                                    $order_delivery = App\Models\OrderDelivery::where('order_id', $ordersGroup[0]->id)->first();
                                    $delivery = $order_delivery ? App\Models\Delivery::where('id', $order_delivery->delivery_id)->first() : null;
                                @endphp

                              
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>الطلبات </td>
                        </tr>
                        <tr>
                            <td> @php
                                $totalPrice = 0;
                            @endphp

                                @foreach ($ordersGroup[0]->products as $product)
                                    @php
                                        $totalPrice += $product->order_item->price;
                                    @endphp
                                @endforeach
                                @php
                                    $totalPrice = $totalPrice - ($totalPrice * $ordersGroup[0]->store->percent) / 100;
                                @endphp
                                {{ Currency::format($totalPrice) }}
                            </td>
                            <td>
                                {{ $ordersGroup[0]->store->name }} 

                            </td>
                        </tr>


                        @foreach ($ordersGroup->skip(1) as $additionalOrder)
                            <tr>
                                <td> @php
                                    $totalPrice = 0;
                                @endphp

                                    @foreach ($additionalOrder->products as $product)
                                        @php
                                            $totalPrice += $product->order_item->price;
                                        @endphp
                                    @endforeach
                                    @php
                                        $totalPrice = $totalPrice - ($totalPrice * $additionalOrder->store->percent) / 100;
                                    @endphp
                                    {{ Currency::format($totalPrice) }}
                                </td>
                                <td>
                                    {{ $additionalOrder->store->name }} 


                                </td>
                            </tr>
                        @endforeach





                    </table>
                    <br>
                @endforeach 







  

                    <!-- Assign Delivery modal -->
                    <div class="modal fade" id="assign_delivery" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('orders_trans.Assign_Delivery') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ Route('delivery.orders.assignDelivery') }}" method="POST">
                                        @csrf


                                        <div class="row">

                                            <div class="col-md-12">
                                                <input name="order_id" id="order_id" hidden />
                                                <input name="cart_id" id="cart_id" hidden />
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> {{ trans('orders_trans.Delivery_Name') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="delivery_id" id="" class="custom-select mr-sm-2">
                                                        <option value="">{{ trans('orders_trans.Choose_Delivery') }}
                                                        </option>
                                                        @foreach ($deliveries as $delivery)
                                                            <option value="{{ $delivery->id }}">{{ $delivery->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('delivery_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('orders_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-success">{{ trans('orders_trans.Submit') }}</button>
                                        </div>

                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@push('scripts')
    <script>
        $('#assign_delivery').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget); // Button that triggered the modal

            var orderId = button.data(
                'order-id'); // Extract the order ID from the button data attribute
            $('#order_id').val(orderId); // Set the value of the hidden input field with the order ID

            var cartId = button.data(
                'cart-id'); // Extract the order ID from the button data attribute
            $('#cart_id').val(cartId); // Set the value of the hidden input field with the order ID

        });
        $(document).ready(function() {
            var datatable = $('#custom_table').DataTable({
                stateSave: true,
                sortable: true,
                responsive: true,
                rowsGroup: [0, 8],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },

                    'colvis'
                ]
            });
        });
    </script>
@endpush
