@extends("layouts.admin-master")
@section("title", "Supplier History")
@section("custom-styles")
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/dt-global_style.css">
@endsection
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><span>Supplier History</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="layout-top-spacing mb-2">
    <div class="col-md-12">
        <div class="row">
            <div class="container p-0">
                <div class="row layout-top-spacing date-table-container">
                    <!-- BASIC -->
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h4 class="table-header">All Stock Transaction</h4>
                            <div class="row">
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
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Products</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($outs as $out)
                                        <tr>
                                            <td>
                                                <a href="{{ route('outs.out.show', ['id' => $out->id]) }}" class="text-primary">
                                                    {{ $out->formatted_number }}
                                                </a>
                                            </td>
                                            <td>{{ date_format(date_create($out->out_date), 'F d, Y') }}</td>
                                            <td>{{ count($out->outs) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Products</th>
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
<script src="/admin/plugins/table/datatable/datatables.js"></script>
<!-- <script src="/admin/assets/js/internal-dt/category.js"></script> -->
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
            var date = new Date(data[1]);

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

                    if (from == data[1]) {
                        return true;
                    }
                } else {
                    var to = new Date($("#to").val());
                    to = to.toLocaleDateString("en-US", {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    if (to == data[1]) {
                        return true;
                    }
                }

            }
        }
    );

    $("#from, #to").on("change", function() {
        minDate = new Date($('#from').val());
        maxDate = new Date($('#to').val());
        dt.draw();
    });
</script>
@endpush