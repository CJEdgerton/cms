@extends('content-management.layouts.app')

@section('content')
<div class="container">
    <div class="row">

    @if( auth()->user()->is_admin )
        <h1>Pages</h1>
    @else
        <h1>My Pages</h1>
    @endif
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Path</th>
                <th>Description</th>

                @if( auth()->user()->is_admin )
                <th>Created By</th>
                @endif
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td><a href="/content-management/pages/{{ $page->id }}">{{ $page->name }}</a></td>
                <td>{{ $page->path }}</td>
                <td>{{ $page->description }}</td>
                @if( auth()->user()->is_admin )
                <td>{{ $page->created_by }}</td>
                @endif
                <td>{{ $page->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}

    <a href="{{ route('pages.create') }}" class="btn btn-primary pull-right mt-22">Create Page</a>
</div>
@endsection
