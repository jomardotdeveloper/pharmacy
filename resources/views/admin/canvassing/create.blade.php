@extends("layouts.admin-master")
@section("title", "Canvassings")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('canvassings.index') }}" class="text-primary">Canvassings</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>Create</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div id="app">
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
                                            <h4>New Canvassing</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('canvassings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="ids" name="ids" value="1" />
                                    <div class="widget-content widget-content-area">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-group">
                                                    <label>Supplier
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-control basic" name="supplier_id" id="supplier_id" required>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-group">
                                                    <label>Date
                                                        <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="purchase_date" value="{{ date('Y-m-d') }}" placeholder="Date" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-center" id="line_ids">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Cost</th>
                                                        <th>Expiration Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="line_1">
                                                        <td>1</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Product
                                                                    <span class="text-danger">*</span></label>
                                                                <select class="form-control basic" name="product_id_1" id="product_id_1" required>
                                                                    @foreach($products as $product)
                                                                    <option value="{{ $product->id }}">{{ $product->full_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Quantity
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control" name="quantity_1" min="1" id="quantity_1" required />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Cost
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control" name="cost_1" min="1" id="cost_1" required />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Expiration Date
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" name="expiration_date_1" id="expiration_date_1" />
                                                            </div>
                                                        </td>
                                                 
                                                        <td><a href="#" onclick="removeLine(1)" id="rmv_1" title="Edit" class="font-20 text-danger"><i class="las la-trash"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-left">
                                                            <a href="#" v-on:click="addNewLine" class="text-primary">
                                                                Add a line
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
</div>
@endsection
@push("custom-scripts")
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            ids: [1]
        },
        methods: {
            addNewLine: function() {
                var last_row = $("#line_ids tbody").children(":last").prev();
                var prev_number = last_row.children(":first").html();

                var cloned = last_row.clone();
                var current_number = parseInt(prev_number) + 1;
                var table_row = cloned.children(":first");
                table_row.html(current_number);
                cloned.attr("id", "line_" + current_number);
                this.ids.push(current_number);

                var product = cloned.children("td").eq(1).children().eq(0).children().eq(1);
                product.attr("name", "product_id_" + current_number);
                product.attr("id", "product_id_" + current_number);

                var quantity = cloned.children("td").eq(2).children().eq(0).children().eq(1);
                quantity.attr("name", "quantity_" + current_number);
                quantity.attr("id", "quantity_" + current_number);

                var expiration_date = cloned.children("td").eq(4).children().eq(0).children().eq(1);
                expiration_date.attr("name", "expiration_date_" + current_number);
                expiration_date.attr("id", "expiration_date_" + current_number);

                var supplier = cloned.children("td").eq(3).children().eq(0).children().eq(1);
                supplier.attr("name", "cost_" + current_number);
                supplier.attr("id", "cost_" + current_number);

                var rmv = cloned.children("td").eq(5).children().eq(0);
                rmv.attr("name", "rmv_" + current_number);
                rmv.attr("id", "rmv_" + current_number);
                rmv.attr("onclick", "removeLine(" + current_number + ")");

                last_row.after(cloned);
                $("#quantity_" + current_number).val("");
                $("#expiration_date_" + current_number).val("");
                $("#ids").val(this.ids.toString());
            },
            removeLine: function(id) {
                $("#line_" + id).remove();
                this.ids.splice(this.ids.indexOf(parseInt(id)), 1);
                $("#ids").val(this.ids.toString());
            }
        }
    });

    function removeLine(id) {
        app.removeLine(id);
    }
</script>
@endpush