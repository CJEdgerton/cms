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
                <th>Created By</th>
                <th>Created At</th>
                <th>Updated By</th>
                <th>Last Updated</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td><a href="/content-management/pages/{{ $page->id }}/edit">{{ $page->name }}</a></td>
                <td>{{ $page->path }}</td>
                <td>{{ $page->description }}</td>
                <td>{{ $page->owner()->withTrashed()->first()->fullName() }}</td>
                <td>{{ $page->created_at }}</td>
                <td>{{ ! is_null( $user = $page->updater ) ? $user->fullName() : "" }}</td>
                <td>{{ $page->updated_at }}</td>
                <td>{{ $page->isActive() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}

    <a href="{{ route('pages.create') }}" class="btn btn-primary pull-right mt-22">Create Page</a>
</div>
@endsection
