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
                <h4 class="mb-2"> اجمالى الطلبات اليومية بتاريخ: {{ $today }}</h4>
                
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
                                <th>الطلب</th>
                                {{-- <th>{{ trans('orders_trans.Id') }}</th> --}}
                                {{-- <th>{{ trans('orders_trans.Delivery_Time') }}</th> --}}
                                <th>المندوب</th> 
                                <th>الشحن</th>
                                <th>النسبة</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $groupedDeliveriesOrders = $deliveries->groupBy('delivery_id');
                                $totalShipping = 0;
                                $totalOrders = 0;
                                $totalPercent = 0;
                                $x=0;

                            @endphp

                            @foreach ($groupedDeliveriesOrders as $delivery_id => $deliveryOrders)
                                @php
 
                                    $totalOrders += $deliveryOrders->count(); 
                                @endphp

                                <tr>
                                    <td  >
                                        {{ $loop->iteration }}
                                    </td>

                                    <td  >
                                        {{ $deliveryOrders[0]->delivery->name }}
                                    </td>

                                     
                            <td>
                                @php
                                    $data= App\Models\OrderDelivery::
                                    where('delivery_id', $deliveryOrders[0]->delivery_id)
                                    ->distinct()->get('cart_id');
                                    $shipping_delilevry=0;
                                @endphp
                                @foreach ($data as $row)
                                @php
                                    
                                    $shipping_orders=App\Models\OrderDelivery::
                                    where('delivery_id', $deliveryOrders[0]->delivery_id)
                                    ->where('cart_id', $row->cart_id) 
                                    ->take(1)->get();
                                    
                                @endphp
                                @foreach ($shipping_orders as $shipping_order)
                                @php
                                    $shipping_delilevry+=$shipping_order->shipping;
                                @endphp
                                    
                                @endforeach
                                
                                    @endforeach
                                    {{ Currency::format($shipping_delilevry) }}  
                                    @php
                                        $totalShipping+=$shipping_delilevry;
                                    @endphp
                            </td>
                            @php
                            $delivry_percent=0;
                        @endphp
                        @foreach ($deliveryOrders as $additionalOrder)
                        @php
                            // $delivry_percent+=  $additionalOrder->order->percent
                        @endphp     
                        @endforeach 
                            <td>
                                @php
                                    $delivry_percent=0;
                                @endphp
                                @foreach ($deliveryOrders as $additionalOrder)
                                @php
                                     $delivry_percent+=  $additionalOrder->order->percent
                                @endphp     
                                @endforeach
                                {{ Currency::format($delivry_percent) }}
                            </td>

                    @php
                        $x=$x+1;
                        $totalPercent+=$delivry_percent;
                    @endphp
                            @endforeach


                            <tr>
                                <td>عدد الطلبات</td> <td colspan="5">{{$x}}</td>
                            </tr>
                            <tr>
                                <td>أجمالى الشحن</td><td colspan="5">{{ Currency::format($totalShipping) }}
                                </td>
                            </tr>
                            <tr>
                                <td>النسبة</td><td colspan="5">{{ $totalPercent }}</td>
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
