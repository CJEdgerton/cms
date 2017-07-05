@extends('content-management.layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">

    <h1 class="text-center">Create a Page</h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="{{ route('pages.index') }}">Manage Pages</a>
        </li>
        <li class="active">
            Create 
        </li>
    </ol>

    <form action="{{ route('pages.store') }}" method="POST" class="form-horizontal">

        <div class="panel panel-default">
            <div class="panel-body">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">Name</label>                        
                    <div class="col-md-8">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name') }}" 
                            placeholder="Page Name" 
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="col-md-2 control-label">Description</label>                        
                    <div class="col-md-8">
                        <textarea 
                            name="description" 
                            class="form-control" 
                            rows="1" 
                            placeholder="Page Description" 
                            required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="path" class="col-md-2 control-label">Path</label>                        
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">{{env('APP_URL')}}/</span>
                            <input 
                                type="text" 
                                name="path" 
                                class="form-control" 
                                placeholder="page-path (Leave blank if unknown)" 
                                value="{{ old('path') }}">
                        </div>
                    </div>
                </div>

                @if( auth()->user()->is_admin )
                    <div class="form-group">
                        <label for="active" class="col-md-2 control-label">Active?</label>    
                        <div class="col-md-8">
                            <select name="active" class="form-control">
                                <option 
                                    {{ old('active') === 0 ? 'selected' : '' }} 
                                    value="0">
                                    No
                                </option>
                                <option 
                                    {{ old('active') === 1 ? 'selected' : '' }} 
                                    value="1">
                                    Yes
                                </option>
                            </select>
                        </div>
                    </div>
                @endif

                <hr>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea name="main_content" id="main-content" class="form-control" rows="8">{{ old('main_content') }}</textarea>
                    </div>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-save pull-right">Save</button>
                        <a href="{{ route('pages.index') }}" class="btn btn-default pull-right">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

@endsection

@include('content-management.includes.pages.tinymce')