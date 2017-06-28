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
        @foreach($active_users as $user)
        <tr>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->first_name }}</td>
            <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
            <td>{{ $user->isAdmin() }}</td>
            <td>{{ $user->created_at->format('Y-m-d') }}</td>
            <td>{{ $user->updated_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('users.edit', ['id' => $user->id]) }}">
                    <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>    

{{ $active_users->links() }}
