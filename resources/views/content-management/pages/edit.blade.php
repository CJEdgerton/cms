@extends('content-management.layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <h1 class="text-center">Edit Page</h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="{{ route('pages.index') }}">Manage Pages</a>
        </li>
        <li>
            <a href="{{ route('pages.show', ['id' => $page->id]) }}">{{ $page->name }}</a>
        </li>
        <li class="active">Edit</li>
    </ol>

    <form action="{{ route('pages.update', ['id' => $page->id]) }}" method="POST">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Page Info</h3>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label for="name">Name</label>                        
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        value="{{ $page->name }}" 
                        placeholder="Page Name" 
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>                        
                    <textarea 
                        name="description" 
                        class="form-control" 
                        rows="3" 
                        placeholder="Page Description" 
                        required>{{ $page->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="path">Path</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">hr.fsu.edu/</span>                
                        <input 
                            type="text" 
                            name="path" 
                            class="form-control" 
                            placeholder="my/page/here" 
                            value="{{ $page->formattedPath() }}">
                    </div>
                    <p class="help-text text-center">Leave blank if unknown</p>
                </div>

                @if(count($errors))
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </div>

            <div class="panel-footer clearfix">

                <div class="form-group">

                    <a class="btn btn-default" data-toggle="modal" href='#modal-id'>
                        <span class="glyphicon glyphicon-trash text-danger pull-left"></span>
                        Delete
                    </a>
                    <button 
                        type="submit" 
                        class="btn btn-primary btn-save pull-right">
                        Save</button>
                    <a 
                        href="{{ route('pages.show', ['id' => $page->id]) }}" 
                        class="btn btn-default pull-right">
                        Cancel</a>
                </div>
            </div>

        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Page Content</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="main_content">Content</label>                        
                    <textarea name="main_content" class="form-control" rows="8">{{ $page->main_content }}</textarea>
                </div>
            </div>
            <div class="panel-footer clearfix">

                <div class="form-group">

                    <a class="btn btn-default" data-toggle="modal" href='#modal-id'>
                        <span class="glyphicon glyphicon-trash text-danger pull-left"></span>
                        Delete
                    </a>

                    <button 
                        type="submit" 
                        class="btn btn-primary btn-save pull-right">
                        Save</button>
                    <a 
                        href="{{ route('pages.show', ['id' => $page->id]) }}" 
                        class="btn btn-default pull-right">
                        Cancel</a>
                </div>
            </div>

        </div>

    </form>

    {{--  --}}

    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Page</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">Are you sure you want to delete this page?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('pages.destroy', ['id' => $page->id]) }}" method="POST" class="pull-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-trash text-danger pull-right btn-save"></span>
                            Delete
                        </button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection