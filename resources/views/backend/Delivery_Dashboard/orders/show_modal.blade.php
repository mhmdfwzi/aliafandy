<!-- Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="showOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showOrderModalLabel">{{ trans('orders_trans.Order') }} {{ $order->number }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-info"> {{ trans('orders_trans.Order_Number') }}</span>
                            </div>
                            <div class="col-md-6">
                                <span> {{ $order->number }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-info"> {{ trans('orders_trans.Client_Name') }}</span>
                            </div>
                            <div class="col-md-6">
                                <span> {{ $order->user->first_name }} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-info"> {{ trans('orders_trans.Delivery_Address') }}</span>
                            </div>
                            <div class="col-md-6">
                                <span> {{ $order->orderDelivery->order_location }} </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-md-3">
                        <span class="text-info"> {{ trans('orders_trans.Products') }}</span>
                    </div>
                    <div class="col-md-9">
                        @foreach ($order->products as $product)
                            <div>
                                {{ $product->name }} { {{ $product->quantity }} }
                            </div>
                        @endforeach
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
