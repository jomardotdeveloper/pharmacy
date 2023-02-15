@extends("layouts.admin-master")
@section("title", "Products")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="text-primary">Products</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>{{ $product->full_name }}</span></li>
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
                                        <h4>{{ $product->full_name }}</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Name
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter Name" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Medicine Type
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="medicine_type" disabled>
                                                    <option value="generic" {{ $product->medicine_type == "generic" ? "selected" : "" }}>Generic</option>
                                                    <option value="branded" {{ $product->medicine_type == "branded" ? "selected" : "" }}>Branded</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Category
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="category_id" readonly="true">
                                                    <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-62">
                                            <div class="form-group">
                                                <label>Measurement
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="measurement" value="{{ $product->measurement }}" placeholder="Enter Measurement" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-62">
                                            <div class="form-group">
                                                <label>Variant
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="variant" value="{{ $product->variant }}" placeholder="Enter Variant" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Supplier Cost
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" step="0.1"   name="srp" value="{{ $product->srp }}" disabled placeholder="Cost" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per pc
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" name="cost_per_pc" value="{{ $product->cost_per_pc }}" placeholder="Cost" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per bundle
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" id="cost_per_bundle" name="cost_per_bundle" value="{{ $product->cost_per_bundle }}" placeholder="Cost" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per half
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" name="cost_per_half" id="cost_per_half" value="{{ $product->cost_per_half }}" placeholder="Cost" readonly="true" />
                                            </div>
                                        </div>
                                        @if($product->quantity_per_half)
                                        <div class="col-xl-3 col-md-3 col-sm-3 col-3" id="quantity_per_half">
                                            <div class="form-group">
                                                <label>Quantity per half
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" id="quantity_per_half_ipt" name="quantity_per_half" value="{{ $product->quantity_per_half }}" placeholder="Quantity" readonly="true" />
                                            </div>
                                        </div>
                                        @endif
                                        @if($product->quantity_per_bundle)
                                        <div class="col-xl-3 col-md-3 col-sm-3 col-3" id="quantity_per_bundle">
                                            <div class="form-group">
                                                <label>Quantity per bundle
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="quantity_per_bundle" id="quantity_per_bundle_ipt" value="{{ $product->quantity_per_bundle }}" placeholder="Quantity" readonly="true" />
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" placeholder="Description" required rows="3" readonly="true">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer text-right">
                                    <form action="{{ route('products.destroy', ['product' => $product]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger mr-2">
                                        <a href="{{ route('products.edit', ['product' => $product]) }}" class="btn btn-primary mr-2">
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