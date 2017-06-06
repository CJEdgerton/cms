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

    <form action="{{ route('pages.store') }}" method="POST">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Page Info</h3>
            </div>
            <div class="panel-body">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name</label>                        
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        value="{{ old('name') }}" 
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
                        required>{{ old('description') }}</textarea>
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
                            value="{{ old('path') }}">
                    </div>

                    <p class="text-center help-text">Leave blank if unknown</p>
                </div>

                <div class="form-group">
                    <label for="active">Active?</label>    

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
                    <button type="submit" class="btn btn-primary btn-save pull-right">Save</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-default pull-right">Cancel</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Page Content</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <textarea name="main_content" id="main-content" class="form-control" rows="8">{{ old('main_content') }}</textarea>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-save pull-right">Save</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-default pull-right">Cancel</a>
                </div>
            </div>
        </div>

    </form>

</div>

@endsection

@include('content-management.includes.tinymce')