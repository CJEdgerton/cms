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

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </a>
            </li>
            <li role="presentation">
                <a href="#info" aria-controls="info" role="tab" data-toggle="tab">
                    <span class="glyphicon glyphicon-info-sign"></span> Info
                </a>
            </li>
            <li role="presentation">
                <a href="#collaboration" aria-controls="collaboration" role="tab" data-toggle="tab">
                    <span class="glyphicon glyphicon-user"></span> Collaborate
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="edit">
                @include('content-management.includes.pages.edit.form')
            </div>

            <div role="tabpanel" class="tab-pane fade" id="info">
                @include('content-management.includes.pages.edit.info')
            </div>

            <div role="tabpanel" class="tab-pane fade" id="collaboration">
                @include('content-management.includes.pages.edit.collaboration')
            </div>
        </div>
    </div>
</div>

@endsection

@include('content-management.includes.pages.tinymce')

@push('scripts')
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});
</script>
@endpush