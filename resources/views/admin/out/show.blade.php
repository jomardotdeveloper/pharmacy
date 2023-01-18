@extends("layouts.admin-master")
@section("title", "Supplier History")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('outs.out') }}" class="text-primary">Supplier History</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>#{{ $out->formatted_number }}</span></li>
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
                                        <h4>#{{ $out->formatted_number }} ({{ date_format(date_create($out->sale_date), 'F d, Y') }})</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Qty</th>
                                            <th>Expiration Date</th>
                                            <th>Supplier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($outs as $current)
                                        <tr>
                                            <td>{{ $current->product->full_name }}</td>
                                            <td>{{ $current->product->category->name }}</td>
                                            <td>{{ $current->quantity }}</td>
                                            <td>{{ $current->expiration_date ? date_format(date_create($current->expiration_date), 'F d, Y') : "N/A" }}</td>
                                            <td>{{ $current->supplier->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="widget-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection