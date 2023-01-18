@extends("layouts.admin-master")
@section("title", "Sales")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('sales.sale') }}" class="text-primary">Sales History</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>#{{ $sale->formatted_number }}</span></li>
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
                                        <h4>#{{ $sale->formatted_number }} ({{ date_format(date_create($sale->sale_date), 'F d, Y') }})</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $current)
                                        <tr>
                                            <td>{{ $current->product->full_name }}</td>
                                            <td>{{ $current->unit }}</td>
                                            <td>{{ $current->quantity }}</td>
                                            <td>₱{{ $current->cost }}</td>
                                            <td>₱{{ $current->total_cost }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <strong>Total</strong> <br />
                                                <strong>Payment</strong> <br />
                                                <strong>Change</strong><br />
                                                <strong>VAT</strong><br />
                                                <strong>Discount</strong> <br/>
                                                <strong>Total Cost W/ VAT & Discount</strong> 
                                            </td>
                                            <td>
                                                ₱{{ $sale->total }} <br />
                                                ₱{{ $sale->payment }} <br />
                                                ₱{{ $sale->change }}<br />
                                                {{ $sale->tax }}%<br />
                                                {{ $sale->discount }}% <br />
                                                ₱{{ $sale->total_with_vat_discount }}
                                            </td>
                                        </tr>

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