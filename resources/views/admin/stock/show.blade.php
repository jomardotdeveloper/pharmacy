@extends("layouts.admin-master")
@section("title", "Stocks")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('stocks.index') }}" class="text-primary">Stocks</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>{{ $stock->product->full_name }} (Arrived : {{ date_format(date_create($stock->date_arrived), 'F d, Y') }})</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="layout-top-spacing mb-2">
    <div class="col-md-12">
        <div class="row">
            <div class="container p-0">
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow mb-4">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{ $stock->product->full_name }} (Arrived : {{ date_format(date_create($stock->date_arrived), 'F d, Y') }})</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="#" method="POST">
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Product
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="product_id" id="product_id" readonly="true">
                                                    <option value="{{ $stock->product->id }}" selected>{{ $stock->product->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Supplier
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="supplier_id" id="supplier_id" readonly="true">
                                                    <option value="{{ $stock->supplier->id }}" selected>{{ $stock->supplier->name }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-8 col-sm-8 col-8">
                                            <div class="form-group">
                                                <label>Expiration Date
                                                    <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'Y-m-d') : null }}" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Quantity
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="quantity" min="1" id="quantity" value="{{ $stock->quantity }}" readonly="true" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="widget-footer text-right">
                                    <form action="{{ route('stocks.destroy', ['stock' => $stock]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger mr-2">
                                        <a href="{{ route('stocks.edit', ['stock' => $stock]) }}" class="btn btn-primary mr-2">
                                            Edit
                                        </a>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection