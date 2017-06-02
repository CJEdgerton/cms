@extends('content-management.layouts.app')

@section('content')
<div class="container">
    <div class="row">

    <h1>Manage Users</h1>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->first_name }}</td>
                <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
                <td>{{ $user->isAdmin() }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('users.show', ['id' => $user->id]) }}">
                        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <a href="{{ route('users.create') }}" class="btn btn-primary pull-right mt-22">Create User</a>
</div>
@endsection
