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
                <h4 class="mb-2"> تقارير الأدمن الكامل للطلبات </h4>
                <h4 class="mb-4"> تاريخ : {{ $today }}</h4>
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

                    <table id="custom_table_1" class="custom_table_1">
                        <thead>
                            <tr>
                                <th>{{ trans('orders_trans.Cart_Number') }}</th>
                                {{-- <th>{{ trans('orders_trans.Id') }}</th> --}}
                                {{-- <th>{{ trans('orders_trans.Delivery_Time') }}</th> --}}
                                <th>{{ trans('orders_trans.Delivery') }}</th>
                                <th>{{ trans('orders_trans.Id') }}</th>

                                {{-- <th>{{ trans('orders_trans.Delivery_Address') }}</th> --}}

                                <th>{{ trans('orders_trans.Price') }}</th>
                                <th>{{ trans('orders_trans.Shipping') }}</th>
                                <th>{{ trans('orders_trans.Percent') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $groupedDeliveriesOrders = $deliveries->groupBy('delivery_id');
                                $totalShipping = 0;
                                $totalOrders = 0;
                                $totalPercent = 0;

                            @endphp

                            @foreach ($groupedDeliveriesOrders as $delivery_id => $deliveryOrders)
                                @php

                                    $totalShipping += $deliveryOrders[0]->order->shipping;
                                    $totalOrders += $deliveryOrders->count();
                                    $totalPercent += $deliveryOrders[0]->order->percent;
                                @endphp

                                <tr>
                                    <td rowspan="{{ $deliveryOrders->count() }}">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td rowspan="{{ $deliveryOrders->count() }}">
                                        {{ $deliveryOrders[0]->delivery->name }}
                                    </td>

                                    <td>
                                        {{ $deliveryOrders[0]->order->id }}
                                    </td>


                                    <td>
                                        @php
                                            $totalPrice = 0;
                                        @endphp

                                        @foreach ($deliveryOrders[0]->order->products as $product)
                                            @php
                                                $totalPrice += $product->price;
                                            @endphp
                                        @endforeach

                                        {{ Currency::format($totalPrice) }}
                                    </td>

                                    <td>
                                        {{ Currency::format($deliveryOrders[0]->order->shipping) }}
                                    </td>

                                    <td>
                                        {{ $deliveryOrders[0]->order->percent }}
                                    </td>


                                </tr>

                                @foreach ($deliveryOrders->skip(1) as $additionalOrder)
                                    <tr>
                                        <td>{{ $additionalOrder->order->id }}</td>


                                        <td>
                                            @php
                                                $totalPrice = 0;
                                            @endphp

                                            @foreach ($additionalOrder->order->products as $product)
                                                @php
                                                    $totalPrice += $product->price;
                                                @endphp
                                            @endforeach

                                            {{ Currency::format($totalPrice) }}
                                        </td>
                                        <td>
                                            {{ Currency::format($additionalOrder->order->shipping) }}
                                        </td>
                                        <td>
                                            {{ Currency::format($additionalOrder->order->percent) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach



                            <tr>
                                <td>أجمالى الشحن</td>
                                <td colspan="5">
                                    {{ Currency::format($totalShipping) }}
                                </td>
                            </tr>

                            <tr>
                                <td>عدد الطلبات</td>
                                <td colspan="5">
                                    {{ $totalOrders }}
                                </td>
                            </tr>

                            <tr>
                                <td>النسية</td>
                                <td colspan="5">
                                    {{ $totalPercent }}
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    {{-- {{ $orders->links() }} --}}
                    <div class="pagination-links d-flex justify-content-center">
                        <a href="{{ route('delivery.reports.adminFullReport', ['date' => $prevDate]) }}"
                            class="btn btn-primary m-2">اليوم السابق</a>

                        <a href="{{ route('delivery.reports.adminFullReport', ['date' => $today]) }}"
                            class="btn btn-primary m-2">اليوم </a>
                        <a href="{{ route('delivery.reports.adminFullReport', ['date' => $nextDate]) }}"
                            class="btn btn-primary m-2">اليوم التالى</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div>



    </div>
    <!-- row closed -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).ready(function() {


                var datatable = $('#custom_table').DataTable({
                    stateSave: true,
                    sortable: true,
                    responsive: true,
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
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },

                        'colvis'
                    ]
                });


            });

            $('#assign_delivery').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var orderId = button.data(
                    'order-id'); // Extract the order ID from the button data attribute
                $('#order_id').val(orderId); // Set the value of the hidden input field with the order ID
            });
        });
    </script>
@endpush
