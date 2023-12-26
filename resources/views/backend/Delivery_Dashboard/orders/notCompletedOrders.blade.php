@extends('backend.layouts.master')

@section('title')
    {{ trans('orders_trans.Orders') }}
@endsection
@push('style')
    <style>
        /* Default styles for the table */
  

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

        .cutom_table_2 {
                display: table;
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .cutom_table_2 th,
            .cutom_table_2 td {
                padding: 2px;
                text-align: right; 
                background-color: #f8f8f8;
                border: 1px solid #e3e2e2;
            }
    </style>
@endpush
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('orders_trans.Not_Completed_Orders') }}</h4>
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
                    <table id="custom_table_2" class="cutom_table_2"  >
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
                          

                            </td>
                            <td>
                                @if ($ordersGroup[0]->status != 'completed')
                                <a href="{{ Route('delivery.orders.changeOrdersStatus', [$ordersGroup[0]->cart_id, 'completed']) }}"
                                    class="btn btn-warning btn-sm">
                                    تم التوصيل
                                </a>
                            @else
                                تم توصيل الطلبات بنجاح
                            @endif
                              
                            <button data-toggle="modal" data-target="#showOrderModal{{ $ordersGroup[0]->id }}"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>

                            @include('backend.Delivery_Dashboard.orders.show_modal', [
                                'order' => $ordersGroup[0],
                                'modalId' => 'showOrderModal' . $ordersGroup[0]->id,
                            ])

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
                        </tr>
                        <tr>
                            <td colspan='2' style="text-align: center">الطلبات </td>
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


  

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@push('scripts')
    <script>
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
