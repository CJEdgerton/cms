@extends('content-management.layouts.app')


@section('content')

<div class="col-md-8 col-md-offset-2">
	<h1 class="text-center">Page Info:</h1>

	<ol class="breadcrumb">
		<li>
			<a href="#">Home</a>
		</li>
		<li>
			<a href="{{ route('pages.index') }}">Manage Pages</a>
		</li>
		<li class="active">
			{{ $page->name }}
		</li>
	</ol>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">Page Info</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
				<dt>Page Name:</dt><dd> {{ $page->name }}</dd>
				<dt>Page Path:</dt><dd> {{ $page->path }}</dd>
				<dt>Page Description:</dt><dd> {{ $page->description }}</dd>
				<dt>Created By:</dt><dd> {{ $page->owner->fullName() }}</dd>
				<dt>Created On:</dt><dd> {{ $page->created_at->toDayDateTimeString() }}</dd>
				<dt>Updated By:</dt><dd> {{ ! is_null( $user = $page->updater ) ? $user->fullName() : "" }}</dd>
				<dt>Last updated:</dt><dd> 
					@if( ! is_null($page->updated_by) )
					on {{ $page->updated_at->format('Y-m-d') }} by {{ $page->updated_by }}
					@else
					no updates yet
					@endif
				</dd>
				<dt>Active:</dt><dd>@if( $page->active ) Yes @else No @endif</dd>
			</dl>
		</div>
        <div class="panel-footer clearfix">

	        @if($page->active)
				<a href="{{ $page->path }}" target="_blank" class="btn btn-default pull-left">View Page</a>
			@else
				<a href="{{ '/preview/' . $page->path }}" target="_blank" class="btn btn-default pull-left">Preview Page</a>
			@endif

            <div class="form-group">
                <a href="{{ route('pages.edit', ['id' => $page->id ]) }}" class="btn btn-primary btn-save pull-right">Edit</a>
                <a href="{{ route('pages.index') }}" class="btn btn-default pull-right">Cancel</a>
            </div>
        </div>
	</div>

	<hr>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">Page Content</h3>
		</div>
		<div class="panel-body">

			@if( ! is_null( $page->main_content ) )
				{!! html_entity_decode($page->main_content) !!}
			@else
				<p>No content yet.</p>
			@endif

		</div>
        <div class="panel-footer clearfix">

	        @if($page->active)
				<a href="{{ $page->path }}" target="_blank" class="btn btn-default pull-left">View Page</a>
			@else
				<a href="{{ '/preview/' . $page->path }}" target="_blank" class="btn btn-default pull-left">Preview Page</a>
			@endif

            <div class="form-group">
                <a href="{{ route('pages.edit', ['id' => $page->id ]) }}" class="btn btn-primary btn-save pull-right">Edit</a>
                <a href="{{ route('pages.index') }}" class="btn btn-default pull-right">Cancel</a>
            </div>
        </div>
	</div>
</div>

@endsection