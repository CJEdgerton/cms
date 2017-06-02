@extends('content-management.layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">

    <h1 class="text-center">Edit User</h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">Manage Users</a>
        </li>
        <li>
            <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->name }}</a>
        </li>
        <li class="active">
            Edit 
        </li>
    </ol>

    {{-- <form action="{{ route('users.store') }}" method="POST">

    </form> --}}

</div>

@endsection