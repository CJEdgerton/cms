@extends('content-management.layouts.app')


@section('content')

	<h1>Page Info:</h1>
	<ul>
		<li>Page Name: {{ $page->name }}</li>
		<li>Page Path: {{ $page->path }}</li>
		<li>Page Description: {{ $page->description }}</li>
		<li>Created By: {{ $page->owner->full_name() }}</li>
		<li>Created On: {{ $page->created_at->toDayDateTimeString() }}</li>
		<li>Last updated by {{ $page->updated_by }} on {{ $page->updated_at->format('Y-m-d') }}</li>
	</ul>

	<hr>

	@if( ! is_null( $page->main_content ) )
		{!! html_entity_decode($page->main_content) !!}
	@else
		<p>No content yet.</p>
	@endif

	<hr>

	<a href="{{ route('pages.edit', ['id' => $page->id]) }}" class="btn btn-default">Edit Page</a>

@endsection