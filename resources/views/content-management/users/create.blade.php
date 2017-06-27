@extends('content-management.layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">

    <h1 class="text-center">Create User</h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">Manage Users</a>
        </li>
        <li class="active">
            Create 
        </li>
    </ol>

    <form action="{{ route('users.store') }}" method="POST">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">User Info</h3>
            </div>
            <div class="panel-body">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="is_admin">Admin?</label>    

                    <select name="is_admin" class="form-control">
                        <option 
                            {{ old('is_admin') === 0 ? 'selected' : '' }} 
                            value="0">
                            No
                        </option>
                        <option 
                            {{ old('is_admin') === 1 ? 'selected' : '' }} 
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
                        value="{{ old('last_name') }}" 
                        placeholder="Last Name" 
                        required>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>                        
                    <input 
                        type="text" 
                        name="first_name" 
                        class="form-control" 
                        value="{{ old('first_name') }}" 
                        placeholder="First Name" 
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>                        
                    <input 
                        type="text" 
                        name="email" 
                        class="form-control" 
                        value="{{ old('email') }}" 
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
                    <button type="submit" class="btn btn-primary btn-save pull-right">Save</button>
                    <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Cancel</a>
                </div>
            </div>
        </div>

    </form>

</div>

@endsection