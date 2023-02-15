@extends("layouts.admin-master")
@section("title", "Reodering")
@section("custom-styles")
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="/admin/plugins/table/datatable/dt-global_style.css">
@endsection
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Branches</a></li> -->
        <li class="breadcrumb-item" aria-current="page"><span>Reordering</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="layout-top-spacing mb-2">
    <div class="col-md-12">
        <div class="row">
            <div class="container p-0">
                <a href="{{route('reorderings.create')}}" class="btn btn-primary">Create Reordering Rule</a>
                <div class="row layout-top-spacing date-table-container">
                    <!-- BASIC -->
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h4 class="table-header">All Rule</h4>
                            <div class="table-responsive mb-4">
                                <table id="basic-dt" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Min Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reorderings as $reordering)
                                        <tr>
                                            <td>
                                                <a href="{{route('reorderings.show', ['reordering' => $reordering])}}" title="Edit" class="text-primary">
                                                    {{$reordering->product->full_name}}
                                                </a>
                                            </td>
                                            <td>{{ $reordering->supplier->name }}</td>
                                            <td>{{ $reordering->quantity}}</td>
                                            <td>{{ $reordering->min_quantity }}</td>
                                            <td><a href="{{route('reorderings.edit', ['reordering' => $reordering])}}" title="Edit" class="font-20 text-primary"><i class="las la-edit"></i></a></td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Product</th>
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Min Quantity</th>
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
<script src="/admin/plugins/table/datatable/datatables.js"></script>
<script src="/admin/assets/js/internal-dt/category.js"></script>
@endpush