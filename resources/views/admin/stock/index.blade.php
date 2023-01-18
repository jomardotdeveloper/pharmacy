@extends("layouts.admin-master")
@section("title", "Stocks")
@section("custom-styles")
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/dt-global_style.css">
@endsection
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Branches</a></li> -->
        <li class="breadcrumb-item" aria-current="page"><span>Stocks</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="layout-top-spacing mb-2">
    <div class="col-md-12">
        <div class="row">
            <div class="container p-0">
                <a href="{{route('stocks.create')}}" class="btn btn-primary">Add New Product</a>
                <div class="row layout-top-spacing date-table-container">
                    <!-- BASIC -->
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            @if($errors->any())
                            <div class="alert alert-success mb-4" role="alert">
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
                            <h4 class="table-header">Stocks</h4>
                            <div class="row mt-2">
                                <div class="col-3">
                                    <div class="form-group">
                                        Filter
                                        <select class="form-control basic" name="filter_by" id="filter_by">
                                            <option value="filter">Filter</option>
                                            <option value="category">Category</option>
                                            <option value="supplier">Supplier</option>
                                            <option value="product">Product</option>
                                            <option value="date_arrived">Date Arrived</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" id="category_id_elm">
                                    <div class="form-group">
                                        Category
                                        <select class="form-control basic" name="category_id" id="category_id">
                                            @foreach($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" id="supplier_id_elm">
                                    <div class="form-group">
                                        Supplier
                                        <select class="form-control basic" name="supplier_id" id="supplier_id">
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" id="product_id_elm">
                                    <div class="form-group">
                                        Product
                                        <select class="form-control basic" name="product_id" id="product_id">
                                            @php($names = [])
                                            @foreach($products as $product)
                                            @if(!in_array($product->name, $names))
                                            {{ array_push($names, $product->name) }}
                                            <option value="{{ $product->name }}">{{ $product->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" id="from_elm">
                                    <div class="form-group">
                                        From
                                        <input type="date" name="from" id="from" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-3" id="to_elm">
                                    <div class="form-group">
                                        To
                                        <input type="date" name="to" id="to" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mb-4">
                                <table id="basic-dt" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Date Arrived</th>
                                            <th>Supplier</th>
                                            <th>Qty</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stocks as $stock)
                                        <tr>
                                            <td>
                                                <a href="{{route('stocks.show', ['stock' => $stock])}}" title="Edit" class="text-primary">
                                                    {{ $stock->product->full_name }}
                                                </a>
                                            </td>
                                            <td>{{ $stock->product->category->name }}</td>
                                            <td>{{date_format(date_create($stock->date_arrived), 'F d, Y')}}</td>
                                            <td>{{ $stock->supplier->name }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->expiration_date ? date_format(date_create($stock->expiration_date), 'F d, Y') : "N/A" }}</td>
                                            <td><a href="{{route('stocks.edit', ['stock' => $stock])}}" title="Edit" class="font-20 text-primary"><i class="las la-edit"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Date Arrived</th>
                                            <th>Supplier</th>
                                            <th>Qty</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
<script src="/admin/plugins/table/datatable/datatables.js"></script>
<!-- <script src="/admin/assets/js/internal-dt/category.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var dt = $('#basic-dt').DataTable({
        "language": {
            "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
            }
        },
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5
    });
    $('#dropdown-dt').DataTable({
        "language": {
            "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
            }
        },
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5
    });
    $('#last-page-dt').DataTable({
        "pagingType": "full_numbers",
        "language": {
            "paginate": {
                "first": "<i class='las la-angle-double-left'></i>",
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>",
                "last": "<i class='las la-angle-double-right'></i>"
            }
        },
        "lengthMenu": [3, 6, 9, 12],
        "pageLength": 3
    });


    var minDate, maxDate;

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = maxDate;
            var max = minDate;
            var date = new Date(data[2]);

            if ($("#from").val() && $("#to").val()) {
                var from = new Date($("#from").val());
                var to = new Date($("#to").val());

                if (date <= to && date >= from) {
                    return true;
                }
            } else {
                if ($("#from").val()) {
                    var from = new Date($("#from").val());
                    from = from.toLocaleDateString("en-US", {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    if (from == data[2]) {
                        return true;
                    }
                } else {
                    var to = new Date($("#to").val());
                    to = to.toLocaleDateString("en-US", {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    if (to == data[2]) {
                        return true;
                    }
                }

            }
        }
    );


    var filterBy = $("#filter_by");

    var category_elm = $("#category_id_elm");
    var product_elm = $("#product_id_elm");
    var supplier_elm = $("#supplier_id_elm");
    var from_elm = $("#from_elm");
    var to_elm = $("#to_elm");

    var category = $("#category_id");
    var product = $("#product_id");
    var supplier = $("#supplier_id");
    var from = $("#from");
    var to = $("#to");

    category_elm.hide();
    product_elm.hide();
    supplier_elm.hide();
    from_elm.hide();
    to_elm.hide();

    filterBy.change(function() {
        if (filterBy.val() == "category") {
            category_elm.show();
        } else if (filterBy.val() == "filter") {
            dt.column(1).search("").draw();
            dt.column(3).search("").draw();
            dt.column(0).search("").draw();
            dt.column(2).search("").draw();
            category_elm.hide();
            product_elm.hide();
            supplier_elm.hide();
            from_elm.hide();
            to_elm.hide();
        } else if (filterBy.val() == "supplier") {
            supplier_elm.show();
        } else if (filterBy.val() == "product") {
            product_elm.show();
        } else if (filterBy.val() == "date_arrived") {
            from_elm.show();
            to_elm.show();
        }
    });

    category.change(function() {
        dt.column(1).search(category.val()).draw();
    });

    supplier.change(function() {
        dt.column(3).search(supplier.val()).draw();
    });

    product.change(function() {
        dt.column(0).search(product.val()).draw();
    });
    $("#from, #to").on("change", function() {
        minDate = new Date($('#from').val());
        maxDate = new Date($('#to').val());
        dt.draw();
    });
    // to.change(function() {
    //     if (from.val()) {

    //     } else {
    //         var options = {
    //             year: 'numeric',
    //             month: 'long',
    //             day: 'numeric'
    //         };
    //         var date = new Date(to.val());
    //         dt.column(2).search(date.toLocaleDateString("en-US", options)).draw();
    //     }
    // });

    // from.change(function() {
    //     if (to.val()) {

    //     } else {
    //         var options = {
    //             year: 'numeric',
    //             month: 'long',
    //             day: 'numeric'
    //         };
    //         var date = new Date(from.val());
    //         dt.column(2).search(date.toLocaleDateString("en-US", options)).draw();
    //     }
    // });
</script>

@endpush