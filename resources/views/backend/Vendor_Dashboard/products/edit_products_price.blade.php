@extends('backend.layouts.master')

@section('title')
    {{ trans('products_trans.Edit_Prices') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('products_trans.Edit_Prices') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ trans('products_trans.Edit_Prices') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('products_trans.Products') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{ Route('vendor.products.update_products_price') }}" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="row">

<table>
    <tr>
        <td>id</td>
        <td>اسم المنتج</td>
        <td>السعر</td>
   
    @foreach ($products as $product)
        <tr> 
                <input class="form-control" name="product_id[]" hidden
                    value="{{ $product->id }}" type="text">
                    <td>
                        {{ $product->id }} 
                    </td>
                <td>
                    <input type="text" name="name[]" disabled
                        value="{{ old('name', $product->name) }}" class="form-control"
                        placeholder="{{ trans('products_trans.Name') }}">
                    @error('name')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </td>
                <td>
                    <input type="text" name="price[]"
                        value="{{ old('price', $product->price) }}"
                        class="form-control"
                        placeholder="{{ trans('products_trans.Price') }}">
                    @error('price')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </td>
             
        </tr>
    @endforeach

    </table>
                        </div>
 
                        <button type="submit" class="btn btn-primary">{{ trans('products_trans.Edit') }}</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var datatable = $('#table_id').DataTable({
                stateSave: true,
                "pageLength": 3
            })
        });
    </script>
@endpush