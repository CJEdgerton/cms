@extends('content-management.layouts.app')


@section('content')

<div class="col-md-8 col-md-offset-2">
	<h1 class="text-center">User Info:</h1>

	<ol class="breadcrumb">
		<li>
			<a href="#">Home</a>
		</li>
		<li>
			<a href="{{ route('pages.index') }}">Manage Pages</a>
		</li>
		<li class="active">
			{{ $user->fullName() }}
		</li>
	</ol>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">User Info</h3>
		</div>
		<div class="panel-body">
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
        <div class="panel-footer clearfix">
            <div class="form-group">
                <a href="{{ route('users.edit', ['id' => $user->id ]) }}" class="btn btn-primary btn-save pull-right">Edit</a>
                <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Cancel</a>
            </div>
        </div>
	</div>
</div>

@endsection