@extends("layouts.admin-master")
@section("title", "Taxes")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('taxes.index') }}" class="text-primary">Tax</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>{{ $tax->name }}</span></li>
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
                                        <h4>Tax {{ $tax->name }}</h4>
                                    </div>
                                </div>
                            </div>
                            <form>
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Name
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $tax->name }}" placeholder="Enter Name" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Percentage
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $tax->percentage }}" placeholder="Enter Name" readonly="true" />
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                                
                            </form>
                            <div class="widget-footer text-right">
                                <form action="{{ route('taxes.destroy', ['tax' => $tax]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger mr-2">
                                    <a href="{{ route('taxes.edit', ['tax' => $tax]) }}" class="btn btn-primary mr-2">
                                        Edit
                                    </a>
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