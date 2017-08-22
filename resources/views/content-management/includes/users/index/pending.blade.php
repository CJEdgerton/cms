<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Request Submitted On</th>
            <th>Approve Request</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pending_users as $pending_user)
        <tr data-user-id="{{ $pending_user->id }}">
            <td>{{ $pending_user->last_name }}</td>
            <td>{{ $pending_user->first_name }}</td>
            <td>{{ $pending_user->email }}</td>
            <td>{{ $pending_user->created_at->format('Y-m-d') }}</td>
            <td>
                <a class="btn btn-primary" data-toggle="modal" href='#approve-registration-modal' onclick="setPendingUser({{$pending_user->id}})">
                    <span class="glyphicon glyphicon-ok"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>    

{{ $pending_users->links() }}


<div class="modal fade" id="approve-registration-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Approve Registration?</h4>
            </div>
            <div class="modal-body">
                Do you want to you want to activate this user? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form action="" style="display: inline;" method="POST" id="registration-approval-form">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="submit" value="Yes" class="btn btn-primary btn-save">
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setPendingUser(pending_user_id) {
        $('#registration-approval-form').attr('action', '/content-management/pending-users/' + pending_user_id + '/approve-registration');
    }
</script>
@endpush