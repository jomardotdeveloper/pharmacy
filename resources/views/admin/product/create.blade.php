@extends("layouts.admin-master")
@section("title", "Products")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="text-primary">Products</a></li>
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
                                        <h4>Create Product</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('products.store') }}" method="POST">
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
                                            <div class="form-group">
                                                <label>Name
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ request()->old('name') }}" placeholder="Enter Name" required />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Medicine Type
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="medicine_type" required>
                                                    <option value="generic">Generic</option>
                                                    <option value="branded">Branded</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Category
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="category_id" required>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-62">
                                            <div class="form-group">
                                                <label>Measurement
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="measurement" value="{{ request()->old('measurement') }}" placeholder="Enter Measurement" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-62">
                                            <div class="form-group">
                                                <label>Variant
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="variant" value="{{ request()->old('variant') }}" placeholder="Enter Variant" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Supplier Cost
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" step="0.1"   name="srp" value="{{ request()->old('srp') }}" placeholder="Cost" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per pc
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" step="0.1"   name="cost_per_pc" value="{{ request()->old('cost_per_pc') }}" placeholder="Cost" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per bundle
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" step="0.1" id="cost_per_bundle" name="cost_per_bundle" value="{{ request()->old('cost_per_bundle') }}" placeholder="Cost" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                            <div class="form-group">
                                                <label>Cost per half
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" step="0.1"  name="cost_per_half" id="cost_per_half" value="{{ request()->old('cost_per_half') }}" placeholder="Cost" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 col-sm-3 col-3" id="quantity_per_half">
                                            <div class="form-group">
                                                <label>Quantity per half
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" min="1" id="quantity_per_half_ipt" name="quantity_per_half" value="{{ request()->old('quantity_per_half') }}" placeholder="Quantity" />
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 col-sm-3 col-3" id="quantity_per_bundle">
                                            <div class="form-group">
                                                <label>Quantity per bundle
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="quantity_per_bundle" id="quantity_per_bundle_ipt" value="{{ request()->old('quantity_per_bundle') }}" placeholder="Quantity" />
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea>
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
@push("custom-scripts")
<script>
    var half = $("#cost_per_half");
    var bundle = $("#cost_per_bundle");
    var qty_half = $("#quantity_per_half");
    var qty_bundle = $("#quantity_per_bundle");
    var qty_half_ipt = $("#quantity_per_half_ipt");
    var qty_bundle_ipt = $("#quantity_per_bundle_ipt");

    function halfChecker(value) {
        if (parseFloat(value) > 0) {
            qty_half.show();
            qty_half_ipt.prop("required", true);
        } else {
            qty_half.hide();
            qty_half_ipt.prop("required", false);
        }
    }

    function bundleChecker(value) {
        if (parseFloat(value) > 0) {
            qty_bundle.show();
            qty_bundle_ipt.prop("required", true);
        } else {
            qty_bundle.hide();
            qty_bundle_ipt.prop("required", false);
        }
    }

    half.change(function() {
        halfChecker(this.value);
    });

    bundle.change(function() {
        bundleChecker(this.value);
    });


    halfChecker(half.val());
    bundleChecker(bundle.val());
</script>
@endpush