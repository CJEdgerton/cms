@extends('content-management.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p class="lead">
                        Get Started
                    </p>
                </div>

            </div>
        </div>
    </div>


    @if( auth()->user()->is_admin )
        <h1>Pages</h1>
    @else
        <h1>My Pages</h1>
    @endif
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Path</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td><a href="/content-management/pages/{{ $page->id }}">{{ $page->name }}</a></td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->path }}</td>
                <td>{{ $page->description }}</td>
                <td>{{ $page->created_by }}</td>
                <td>{{ $page->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $pages->links() }} --}}

    {{-- <a href="{{ route('pages.create') }}" class="btn btn-primary pull-right mt-22">Create Page</a> --}}
    <a href="#" class="btn btn-primary pull-right mt-22">Create Page</a>
</div>
@endsection
