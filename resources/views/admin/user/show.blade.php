@extends("layouts.admin-master")
@section("title", "Users")
@section("breadcrumbs")
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="text-primary">Users</a></li>
        <li class="breadcrumb-item" aria-current="page"><span>{{ $user->username }}</span></li>
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
                                        <h4>{{ $user->username }}</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="widget-content widget-content-area">
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
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Username
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ $user->username }}" placeholder="Enter Username" readonly="true" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <div class="form-group">
                                                <label>Role
                                                    <span class="text-danger">*</span></label>
                                                <select class="form-control basic" name="role" readonly="true">
                                                    <option value="{{ $user->role }}">{{ $user->role }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer text-right">
                                    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger mr-2">
                                        <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary mr-2">
                                            Edit
                                        </a>
                                        <a href="{{ route('users.reset_password', ['id' => $user->id]) }}" class="btn btn-warning mr-2">
                                            Reset Password
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