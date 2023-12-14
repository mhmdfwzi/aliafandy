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

                    <table id="custom_table_1" class="custom_table_1">
                        <thead>
                            <tr>
                                {{-- <th>{{ trans('orders_trans.Cart_Number') }}</th> --}}
                                <th>{{ trans('orders_trans.Id') }}</th>
                                <th>{{ trans('orders_trans.User_Name') }}</th>
                                <th>{{ trans('orders_trans.Store_Name') }}</th>
                                <th>{{ trans('orders_trans.Category_Name') }}</th>
                                <th>{{ trans('orders_trans.Status') }}</th>
                                <th>{{ trans('orders_trans.Order_Number') }}</th>
                                <th>{{ trans('orders_trans.Total') }}</th>
                                <th>{{ trans('orders_trans.Delivery_Status') }}</th>
                                <th>{{ trans('orders_trans.Control') }}</th>
                            </tr>
                        </thead>


                        <tbody>
                            @php
                                $groupedOrders = $orders->groupBy('cart_id');
                            @endphp

                            @foreach ($groupedOrders as $cartId => $ordersGroup)
                                <tr>
                                    <!-- Cart ID with rowspan -->
                                    {{-- <td rowspan="{{ $ordersGroup->count() }}">{{ $cartId }}</td> --}}

                                    <!-- First order's details -->
                                    <td>{{ $ordersGroup[0]->id }}</td>
                                    <td>{{ $ordersGroup[0]->user->first_name }}</td>
                                    <td>{{ $ordersGroup[0]->store->name }}</td>
                                    <td>
                                        @foreach ($ordersGroup[0]->products as $product)
                                            / {{ $product->category->name }}
                                        @endforeach
                                    </td>


                                    <td>
                                        @if ($ordersGroup[0]->status == 'pending')
                                            <span class="badge badge-rounded badge-info p-2 mb-2">
                                                {{ trans('orders_trans.Pending') }}
                                            </span>
                                        @elseif($ordersGroup[0]->status == 'processing')
                                            <span class="badge badge-rounded badge-primary p-2 mb-2">
                                                {{ trans('orders_trans.Processing') }}
                                            </span>
                                        @elseif($ordersGroup[0]->status == 'delivering')
                                            <span class="badge badge-rounded badge-warning p-2 mb-2">
                                                {{ trans('orders_trans.Delivering') }}
                                            </span>
                                        @elseif($ordersGroup[0]->status == 'completed')
                                            <span class="badge badge-rounded badge-success p-2 mb-2">
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
                                    <td>{{ $ordersGroup[0]->number }}</td>


                                    <td>
                                        @php
                                            $totalPrice = 0;
                                        @endphp

                                        @foreach ($ordersGroup[0]->products as $product)
                                            @php
                                                $totalPrice += $product->price;
                                            @endphp
                                        @endforeach

                                        {{ Currency::format($totalPrice) }}
                                    </td>


                                    <td rowspan="{{ $ordersGroup->count() }}">
                                        @if ($ordersGroup[0]->status != 'completed')
                                            <a href="{{ Route('delivery.orders.changeOrdersStatus', [$ordersGroup[0]->cart_id, 'completed']) }}"
                                                class="btn btn-warning btn-sm">
                                                تم التوصيل
                                            </a>
                                        @else
                                            تم توصيل الطلبات بنجاح
                                        @endif

                                    </td>




                                    <td>
                                        @if (!$delivery_admin)
                                            <button data-toggle="modal"
                                                data-target="#showOrderModal{{ $ordersGroup[0]->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            @include('backend.Delivery_Dashboard.orders.show_modal', [
                                                'order' => $ordersGroup[0],
                                                'modalId' => 'showOrderModal' . $ordersGroup[0]->id,
                                            ])
                                        @endif

                                    </td>
                                </tr>



                                @foreach ($ordersGroup->skip(1) as $additionalOrder)
                                    <tr>
                                        <!-- Only display order details (except cart ID) for additional rows -->
                                        <td>{{ $additionalOrder->id }}</td>
                                        <td>{{ $additionalOrder->user->first_name }}</td>
                                        <td>{{ $additionalOrder->store->name }}</td>
                                        <td>
                                            @foreach ($additionalOrder->products as $product)
                                                / {{ $product->category->name }}
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($additionalOrder->status == 'pending')
                                                <span class="badge badge-rounded badge-info p-2 mb-2">
                                                    {{ trans('orders_trans.Pending') }}
                                                </span>
                                            @elseif($additionalOrder->status == 'processing')
                                                <span class="badge badge-rounded badge-primary p-2 mb-2">
                                                    {{ trans('orders_trans.Processing') }}
                                                </span>
                                            @elseif($additionalOrder->status == 'delivering')
                                                <span class="badge badge-rounded badge-waring p-2 mb-2">
                                                    {{ trans('orders_trans.Delivering') }}
                                                </span>
                                            @elseif($additionalOrder->status == 'completed')
                                                <span class="badge badge-rounded badge-success p-2 mb-2">
                                                    {{ trans('orders_trans.Completed') }}
                                                </span>
                                            @elseif($additionalOrder->status == 'cancelled')
                                                <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                    {{ trans('orders_trans.Cancelled') }}
                                                </span>
                                            @elseif($additionalOrder->status == 'refunded')
                                                <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                    {{ trans('orders_trans.Refunded') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $additionalOrder->number }}</td>
                                        <td>
                                            @php
                                                $totalPrice = 0;
                                            @endphp

                                            @foreach ($additionalOrder->products as $product)
                                                @php
                                                    $totalPrice += $product->price;
                                                @endphp
                                            @endforeach

                                            {{ Currency::format($totalPrice) }}
                                        </td>


                                        <td>
                                            <button data-toggle="modal"
                                                data-target="#showOrderModal{{ $additionalOrder->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            @include('backend.Delivery_Dashboard.orders.show_modal', [
                                                'order' => $additionalOrder,
                                                'modalId' => 'showOrderModal' . $additionalOrder->id,
                                            ])

                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>


                    {{-- mobile table --}}
                    <table id="custom_table_2" class="cutom_table_2">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>{{ trans('orders_trans.Cart_Number') }}</th> --}}
                                <th>{{ trans('orders_trans.Id') }}</th>
                                <th>{{ trans('orders_trans.Delivered') }}</th>
                                <th>{{ trans('orders_trans.Control') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $groupedOrders = $orders->groupBy('cart_id');
                            @endphp

                            @foreach ($groupedOrders as $cartId => $ordersGroup)
                                <tr>
                                    <!-- Cart ID with rowspan -->
                                    <td rowspan="{{ $ordersGroup->count() }}">
                                        {{-- {{ $cartId }} --}}
                                        {{ $loop->iteration }}
                                    </td>

                                    <!-- First order's details -->
                                    <td>{{ $ordersGroup[0]->id }}</td>

                                    <td rowspan="{{ $ordersGroup->count() }}">
                                        @if ($ordersGroup[0]->status != 'completed')
                                            <a href="{{ Route('delivery.orders.changeOrdersStatus', [$ordersGroup[0]->cart_id, 'completed']) }}"
                                                class="btn btn-warning btn-sm">
                                                تم التوصيل
                                            </a>
                                        @else
                                            تم توصيل الطلبات بنجاح
                                        @endif

                                    </td>

                                    <td>
                                        @if (!$delivery_admin)
                                            <button data-toggle="modal"
                                                data-target="#showOrderModal1{{ $ordersGroup[0]->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            @include('backend.Delivery_Dashboard.orders.mobile_modal', [
                                                'order' => $ordersGroup[0],
                                                'modalId' => 'showOrderModal1' . $ordersGroup[0]->id,
                                            ])
                                        @endif
                                    </td>
                                </tr>



                                @foreach ($ordersGroup->skip(1) as $additionalOrder)
                                    <tr>
                                        <!-- Only display order details (except cart ID) for additional rows -->
                                        <td>{{ $additionalOrder->id }}</td>

                                        <td>
                                            <button data-toggle="modal"
                                                data-target="#showOrderModal1{{ $additionalOrder->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            @include('backend.Delivery_Dashboard.orders.mobile_modal', [
                                                'order' => $additionalOrder,
                                                'modalId' => 'showOrderModal1' . $additionalOrder->id,
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>

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
