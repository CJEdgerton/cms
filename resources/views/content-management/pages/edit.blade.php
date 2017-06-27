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
         <li class="active">
            {{ $page->name }}
        </li>
    </ol>

    <form action="{{ route('pages.update', ['id' => $page->id]) }}" class="form-horizontal" method="POST">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">Name</label>                        
                    <div class="col-md-8">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ $page->name }}" 
                            placeholder="Page Name" 
                            required>
                    </div>
                    <div class="col-md-2">
                        <a 
                            data-toggle="modal" 
                            style="font-size: 1.3em;" 
                            href="#page-info-modal">
                            <span class="glyphicon glyphicon-info-sign pull-right"></span>
                        </a>
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
                            required>{{ $page->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="path" class="col-md-2 control-label">Path</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">hr.fsu.edu/</span>                
                            <input 
                                type="text" 
                                name="path" 
                                class="form-control" 
                                placeholder="page-path (Leave blank if unknown)" 
                                value="{{ $page->formattedPath() }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="active" class="col-md-2 control-label">Active?</label>    
                    <div class="col-md-8">
                        <select name="active" class="form-control">
                            <option 
                                {{ $page->active === 0 ? 'selected' : '' }} 
                                value="0">
                                No
                            </option>
                            <option 
                                {{ $page->active === 1 ? 'selected' : '' }} 
                                value="1">
                                Yes
                            </option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea name="main_content" id="main-content" class="form-control" rows="8">{{ $page->main_content }}</textarea>
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

                        <a class="btn btn-default pull-left" data-toggle="modal" href='#modal-id'>
                            <span class="glyphicon glyphicon-trash text-danger"></span>
                            Delete
                        </a>

                        <button 
                            type="submit" 
                            class="btn btn-primary btn-save pull-right">
                            Save</button>
                        <a 
                            href="{{ route('pages.index') }}" 
                            class="btn btn-default pull-right">
                            Back</a>
                    </div>
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
                    <h4 class="modal-title">Delete {{ $page->name }}</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">Are you sure you want to delete this page?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('pages.destroy', ['id' => $page->id]) }}" method="POST" class="pull-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-save pull-right">
                            Delete
                        </button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="page-info-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>Created By:</dt><dd> {{ $page->owner->fullName() }}</dd>
                        <dt>Created On:</dt><dd> {{ $page->created_at->toDayDateTimeString() }}</dd>
                        <dt>Updated By:</dt><dd> {{ ! is_null( $user = $page->updater ) ? $user->fullName() : "" }}</dd>
                        <dt>Last updated:</dt><dd> 
                            @if( ! is_null($page->updated_by) )
                            {{ $page->updated_at->toDayDateTimeString() }}
                            @else
                            no updates yet
                            @endif
                        </dd>
                        <dt>Active:</dt><dd>@if( $page->active ) Yes @else No @endif</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('content-management.includes.tinymce')

@push('scripts')
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});
</script>
@endpush