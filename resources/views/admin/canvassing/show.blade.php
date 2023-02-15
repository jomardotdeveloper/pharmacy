@extends("layouts.admin-master")
@section("title", "Canvassing")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('canvassings.index') }}" class="text-primary">Canvassing</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>#{{ $canvassing->formatted_number }}</span></li>
    </ol>
</nav>
@endsection
@section("content")
<div class="layout-top-spacing mb-2">
    <div class="col-md-12">
        <div class="row">
            <div class="container p-0">
                <form action="{{route('canvassings.update', ['canvassing' => $canvassing])}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-primary">Approve</button>
                </form>
                {{-- <a href="{{route('canvassings.update', ['canvassing' => $canvassing])}}" class="btn btn-primary">Approve</a> --}}
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow mb-4">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>#{{ $canvassing->formatted_number }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($canvassing->lines as $po)
                                        <tr>
                                            <td>{{ $po->product->full_name }}</td>
                                            <td>{{ $po->quantity }}</td>
                                            <td>₱{{ $po->cost }}</td>
                                            <td>₱{{ $po->total_cost }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <strong>Total</strong>
                                            </td>
                                            <td>
                                                ₱{{ $canvassing->total }}
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