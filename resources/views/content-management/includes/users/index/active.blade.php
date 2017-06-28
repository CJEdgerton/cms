<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($active_users as $user)
        <tr class="js-user-row cursor-pointer" data-user-id="{{ $user->id }}">
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->isAdmin() }}</td>
            <td>{{ $user->created_at->format('Y-m-d') }}</td>
            <td>{{ $user->updated_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>    

{{ $active_users->links() }}

@push('scripts')
<script>
    $('tr.js-user-row').click(function() {
        user_id = $(this).data('user-id');
        window.location = '/content-management/users/' + user_id + '/edit';
    });
</script>
@endpush
