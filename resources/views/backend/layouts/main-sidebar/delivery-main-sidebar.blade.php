<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ Route('delivery.dashboard') }}"><i class="fa-solid fa-house fa-fade"></i><span
                                class="right-nav-text">
                                {{ trans('sidebar_trans.Dashboard') }}
                            </span>
                        </a>
                    </li>


                    <!-- menu title -->
                    {{-- <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('sidebar_trans.Elements') }} </li> --}}


                    {{-- @can('viewAny', App\Models\Delivery::class) --}}
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#orders-menu">
                            <div class="pull-left"><i class="fa-solid fa-cart-shopping fa-fade"></i><span
                                    class="right-nav-text">{{ trans('sidebar_trans.Orders') }} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="orders-menu" class="collapse" data-parent="#sidebarnav">
                            {{-- delivery --}}
                            @can('view', App\Models\Delivery::class)
                                <li>
                                    <a href="{{ Route('delivery.orders.notCompletedOrders') }}">
                                        {{ trans('sidebar_trans.Not_Completed_Orders') }}</a>
                                </li>

                                <li> <a
                                        href="{{ Route('delivery.orders.index') }}">{{ trans('sidebar_trans.All_Orders') }}</a>
                                </li>
                            @endcan

                            {{-- delivery admin --}}
                            @can('viewAny', App\Models\Delivery::class)
                                <li> <a
                                        href="{{ Route('delivery.orders.adminOrders') }}">{{ trans('sidebar_trans.Admin_Orders') }}</a>
                                </li>
                            @endcan
                            {{-- <li> <a
                                        href="{{ route('delivery.orders.reports', ['pending']) }}">{{ trans('sidebar_trans.Pending_Orders') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('delivery.orders.reports', ['processing']) }}">{{ trans('sidebar_trans.Processing_Orders') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('delivery.orders.reports', ['delivering']) }}">{{ trans('sidebar_trans.Delivering_Orders') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('delivery.orders.reports', ['completed']) }}">{{ trans('sidebar_trans.Completed_Orders') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('delivery.orders.reports', ['cancelled']) }}">{{ trans('sidebar_trans.Cancelled_Orders') }}</a>
                                </li>
                                <li> <a
                                        href="{{ route('delivery.orders.reports', ['refunded']) }}">{{ trans('sidebar_trans.Refunded_Orders') }}</a>
                                </li> --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports-menu">
                            <div class="pull-left"><i class="fa-solid fa-cart-shopping fa-fade"></i><span
                                    class="right-nav-text">{{ trans('sidebar_trans.Reports') }} </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reports-menu" class="collapse" data-parent="#sidebarnav">
                            {{-- delivery --}}
                            @can('view', App\Models\Delivery::class)
                                <li> <a
                                        href="{{ Route('delivery.reports.deliveryReport') }}">{{ trans('sidebar_trans.Delivery_Reports') }}</a>
                                </li>
                            @endcan

                            {{-- admin --}}
                            @can('viewAny', App\Models\Delivery::class)
                                <li> <a
                                        href="{{ Route('delivery.reports.adminReport') }}">{{ trans('sidebar_trans.Admin_Delivery_Reports') }}</a>
                                </li>

                                <li> <a
                                        href="{{ Route('delivery.reports.adminFullReport') }}">{{ trans('sidebar_trans.Admin_Delivery_Full_Reports') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>





                </ul>
                </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
