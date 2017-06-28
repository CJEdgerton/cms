@extends('content-management.layouts.app')

@section('content')
<div class="container">
    <div class="row">

    <h1>Manage Users</h1>

    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#active" aria-controls="active" role="tab" data-toggle="tab">Active</a>
            </li>
            <li role="presentation">
                <a href="#deleted" aria-controls="deleted" role="tab" data-toggle="tab">Deleted</a>
            </li>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="active">
                @include('content-management.includes.users.index.active')
            </div>
            <div role="tabpanel" class="tab-pane" id="deleted">
                @include('content-management.includes.users.index.deleted')
            </div>
        </div>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary pull-right mt-22">Create User</a>
</div>
@endsection
