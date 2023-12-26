@extends('backend.layouts.master')

@section('title')
    {{ trans('orders_trans.Orders') }}
@endsection
@push('style')
<style>
    /* Default styles for the table */
    .custom_table_1 th,
        .custom_table_1 td {
            border: 1px solid #ddd;
            padding: 1px;
            text-align: center;
           
        }
        .custom_table_1{
            width: 100%;
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
                <h4 class="mb-2"> تقارير الدليفرى للطلبات تاريخ : {{ $today }}</h4>
               
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
                    $totalShipping = 0;
                    $totalOrders = 0;
                    $totalPercent = 0;
                    $x=0
                @endphp
                @foreach ($groupedOrders as $cartId => $ordersGroup)
                   
                <table id="custom_table_2" class="cutom_table_2"  >

    <tr>
        <td>كود</td>
        <td> {{ $loop->iteration }}</td>
    </tr>
    <tr>
        <td>التوقيت</td>
        <td> {{ \Carbon\Carbon::parse($ordersGroup[0]->orderDelivery->order_delivery_time)->format('h:i A') }}</td>
    </tr>
    <tr>
        <td>العميل</td>
        <td>{{ $ordersGroup[0]->user->first_name }}
        <br/>
        {{ $ordersGroup[0]->billingAddress->neighborhood_id }}

        </td>
    </tr>
    <tr>
        <td>الشحن</td>
        <td>{{ Currency::format($ordersGroup[0]->shipping) }}</td>
    </tr>
    <tr>
        <td>النسبة</td>
        <td>
            @php
                $order_percent =0;
            @endphp
        @foreach($ordersGroup as $order) 
@php
    $order_percent +=$order->percent;
@endphp 
        @endforeach
        {{ Currency::format($order_percent) }}
       
         </td>
    </tr>
    <tr>
        <td>المندوب</td>
        <td> {{ $ordersGroup[0]->orderDelivery->delivery->name }}</td>
    </tr>
   
</table>
<br/>
@php
$x =$x+1;
$totalShipping += $ordersGroup[0]->shipping;

@endphp

@foreach($ordersGroup as $order) 
@php
$totalPercent +=$order->percent;
@endphp 
@endforeach

@endforeach


<table id="custom_table_1" class="custom_table_1">
                  
    <tbody>
        <tr>
            <td>عدد الطلبات</td>
            <td colspan="8">{{ $x }} </td>
        </tr>
        <tr>
            <td width="30%">أجمالى الشحن</td>
            <td colspan="8">  {{ Currency::format($totalShipping) }}</td>
        </tr>
        <tr>
            <td>النسبه</td>
            <td colspan="8">{{ Currency::format($totalPercent) }}</td>
        </tr>
    </tbody>
</table>


                    {{-- {{ $orders->links() }} --}}
                    <div class="pagination-links d-flex justify-content-center">
                        <a href="{{ route('delivery.reports.deliveryReport', ['date' => $prevDate]) }}"
                            class="btn btn-primary m-2">اليوم السابق</a>

                        <a href="{{ route('delivery.reports.deliveryReport', ['date' => $today]) }}"
                            class="btn btn-primary m-2">اليوم </a>
                        <a href="{{ route('delivery.reports.deliveryReport', ['date' => $nextDate]) }}"
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
