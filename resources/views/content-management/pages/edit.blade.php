@extends('content-management.layouts.app')


@section('content')

<h1>Edit Page</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ route('pages.update', ['id' => $page->id]) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('PUT') }}


            <div class="form-group">
                <label for="name">Name</label>                        
                <input type="text" name="name" class="form-control" value="{{ $page->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>                        
                <textarea name="description" class="form-control" rows="8" required>{{ $page->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="path">Path</label>                        
                <input type="text" name="path" class="form-control" value="{{ $page->path }}" required>
                <p class="help-text">Leave blank if unknown</p>
            </div>

            <div class="form-group">
                <label for="main_content">Content</label>                        
                <textarea name="main_content" class="form-control" rows="8">{{ $page->main_content }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('pages.show', ['id' => $page->id]) }}" class="btn btn-default">Cancel</a>
            </div>

            @if(count($errors))
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </form>

        <form action="{{ route('pages.destroy', ['id' => $page->id]) }}" method="POST" class="pull-right">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-trash text-danger"></span>
                Delete
            </button>
        </form>
    </div>
</div>

@endsection