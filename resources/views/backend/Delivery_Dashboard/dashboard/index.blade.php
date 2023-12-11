@extends('backend.layouts.master')

@section('title')
    {{ trans('dashboard_trans.Dashboard') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('dashboard_trans.Dashboard') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">

                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->

    <div class="row">
        <div class="col-md-12 mt-30 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="row">


                        {{-- pending Orders --}}
                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-warning">
                                                <i class="fa-solid fa-cart-shopping highlight-icon"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">عدد الطلبات المعلقة</p>
                                            <h4>{{ $pendingOrdersCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href=""
                                            target="_blank"><span class="text-danger">عرض
                                                البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Completed Orders --}}
                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa-solid fa-cart-shopping highlight-icon"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">عدد الطلبات المكتملة</p>
                                            <h4>{{ $completedOrdersCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href=""
                                            target="_blank"><span class="text-danger">عرض
                                                البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>


                        {{-- all Orders --}}
                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-info">
                                                <i class="fa-solid fa-cart-shopping highlight-icon"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">عدد كل الطلبات</p>
                                            <h4>{{ $allOrdersCount }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href=""
                                            target="_blank"><span class="text-danger">عرض
                                                البيانات</span></a>
                                    </p>
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
@endpush
