@extends("layouts.admin-master")
@section("title", "Stocks")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('stocks.index') }}" class="text-primary">Stocks</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('stocks.show', ['stock' => $stock]) }}" class="text-primary">{{ $stock->product->full_name }} (Arrived : {{ date_format(date_create($stock->date_arrived), 'F d, Y') }})</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>Edit</span></li>
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
                                        <h4>Edit</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('stocks.update', ['stock' => $stock]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if($errors->any())
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="las la-times"></i>
                                    </button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Product
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="product_id" id="product_id" required>
                                                    @foreach($products as $product)
                                                    @if($product->id == $stock->product->id)
                                                    <option value="{{ $product->id }}" selected>{{ $product->full_name }}</option>
                                                    @else
                                                    <option value="{{ $product->id }}">{{ $product->full_name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Supplier
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="supplier_id" id="supplier_id" required>
                                                    @foreach($suppliers as $supplier)
                                                    @if($supplier->id == $stock->supplier->id)
                                                    <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                                                    @else
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-8 col-sm-8 col-8">
                                            <div class="form-group">
                                                <label>Expiration Date
                                                    <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'Y-m-d') : null }}" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Quantity
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="quantity" min="1" id="quantity" value="{{ $stock->quantity }}" required />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="widget-footer text-right">
                                    <input type="submit" value="Save" class="btn btn-primary mr-2" />
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