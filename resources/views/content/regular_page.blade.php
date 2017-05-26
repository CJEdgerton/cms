@extends('content.layouts.main')

@section('content')
	@if( ! is_null( $page->main_content ) )
		{!! html_entity_decode($page->main_content) !!}
	@else
		<p>No content yet.</p>
	@endif
@endsection