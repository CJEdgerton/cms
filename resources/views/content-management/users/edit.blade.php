@extends('content-management.layouts.app')

@section('content')

<div class="col-md-4 col-md-offset-4">

    <h1 class="text-center">Edit User</h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">Manage Users</a>
        </li>
        <li class="active">
            {{ $user->fullName() }}
        </li>
    </ol>

    @if ( is_null( $user->deleted_at ) )
        <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">User Info</h3>
                    <a 
                        data-toggle="modal"
                        class="pull-right" 
                        href="#user-info-modal">
                        <span class="glyphicon glyphicon-info-sign"></span>
                    </a>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="is_admin">Admin?</label>    

                        <select name="is_admin" class="form-control">
                            <option 
                                {{ $user->is_admin ? 'selected' : '' }} 
                                value="0">
                                No
                            </option>
                            <option 
                                {{ $user->is_admin ? 'selected' : '' }} 
                                value="1">
                                Yes
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>                        
                        <input 
                            type="text" 
                            name="last_name" 
                            class="form-control" 
                            value="{{ $user->last_name }}" 
                            placeholder="Last Name" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name</label>                        
                        <input 
                            type="text" 
                            name="first_name" 
                            class="form-control" 
                            value="{{ $user->first_name }}" 
                            placeholder="First Name" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>                        
                        <input 
                            type="text" 
                            name="email" 
                            class="form-control" 
                            value="{{ $user->email }}" 
                            placeholder="Email" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>                        
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Password" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>                        
                        <input 
                            type="password" 
                            name="confirm_password" 
                            class="form-control" 
                            placeholder="Confirm Password" 
                            required>
                    </div>

                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul class="">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="panel-footer clearfix">
                    <div class="form-group">

                        <a class="btn btn-default pull-left" data-toggle="modal" href='#modal-id'>
                            <span class="glyphicon glyphicon-trash text-danger"></span>
                            Delete
                        </a>

                        <button type="submit" class="btn btn-primary btn-save pull-right">Save</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Cancel</a>

                    </div>
                </div>
            </div>

        </form>
    @else

        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">User Info</h3>
                <a 
                    data-toggle="modal"
                    class="pull-right" 
                    href="#user-info-modal">
                    <span class="glyphicon glyphicon-info-sign"></span>
                </a>
            </div>
            <div class="panel-body">

                <p class="lead text-center">
                    This user is currently deleted, would you like to re-activate them?
                </p>

            </div>
            <div class="panel-footer clearfix">
                <div class="form-group">

                    <a href="{{ route('users.restore', ['id' => $user->id]) }}" class="btn btn-success btn-save pull-right">Yes</a>
                    <a href="{{ route('users.index') }}" class="btn btn-danger pull-right">No</a>

                </div>
            </div>
        </div>

    @endif

</div>

{{--  --}}


@if ( is_null( $user->deleted_at ) )
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete {{ $user->name }}</h4>
                </div>
                <div class="modal-body">
                    <p class="lead text-center">Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" class="pull-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-save pull-right">
                            Delete
                        </button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="user-info-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <dl class="dl-horizontal">
                    <dl class="dl-horizontal">
                        <dt>Last Name:</dt><dd> {{ $user->last_name }}</dd>
                        <dt>First Name:</dt><dd> {{ $user->first_name }}</dd>
                        <dt>Admin:</dt><dd> {{ $user->isAdmin() }}</dd>
                        <dt>Email:</dt><dd> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>
                        <dt>Created On:</dt><dd> {{ $user->created_at->toDayDateTimeString() }}</dd>
                        <dt>Last updated:</dt><dd> 
                        @if( ! is_null($user->updated_at) )
                        {{ $user->updated_at->toDayDateTimeString() }}
                        @else
                        No updates yet
                        @endif
                    </dd>
                    {{-- <dt>Active:</dt><dd>@if( $user->active ) Yes @else No @endif</dd> --}}
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection