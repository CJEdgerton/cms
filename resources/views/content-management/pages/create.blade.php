@extends('content-management.layouts.app')

@section('content')

<h1>Create a Page</h1>
<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ route('pages.store') }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>                        
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>                        
                <textarea name="description" class="form-control" rows="8" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="path">Path</label>                        
                <input type="text" name="path" class="form-control" value="{{ old('path') }}" required>
                <p class="help-text">Leave blank if unknown</p>
            </div>

            <div class="form-group">
                <label for="main_content">Content</label>                        
                <textarea name="main_content" class="form-control" rows="8">{{ old('main_content') }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

            @if(count($errors))
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </form>
    </div>
</div>

@endsection