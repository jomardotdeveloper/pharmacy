@extends("layouts.admin-master")
@section("title", "Reorderings")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('reorderings.index') }}" class="text-primary">Reorderings</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>Create</span></li>
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
                                        <h4>Create Rule</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('reorderings.store') }}" method="POST">
                                @csrf
                                <div class="widget-content widget-content-area">
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
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <label>Product
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control basic" name="product_id" id="product_id_1" required>
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Supplier
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="supplier_id" id="supplier_id_1" required>
                                                    @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-6 col-sm-6 col6" id="quantity_per_half">
                                            <div class="form-group">
                                                <label>Min Quantity 
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" id="quantity_per_half_ipt" name="min_quantity" placeholder="Quantity" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6" id="quantity_per_bundle">
                                            <div class="form-group">
                                                <label>Quantity 
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="quantity" id="quantity_per_bundle_ipt"  placeholder="Quantity" />
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