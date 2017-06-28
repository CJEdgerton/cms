{{-- <form action="{{ route('pages.add_collaborators', ['id' => $page->id]) }}" class="form-horizontal" method="POST"> --}}
<form class="form-horizontal">

    <div class="panel panel-default">
        <div class="panel-body">

            <p class="lead text-center">
                Collaborate with other users.
            </p>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label class="control-label col-md-3">Add Collaborators</label>
                        <div class="col-md-9">
                            <select name="collaborators[]" class="form-control selectize" required="required" multiple>
                                <option value></option>
                                @foreach( $page->potentialCollaborators() as $user )
                                    <option value="{{ $user->id }}">{{ $user->fullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer clearfix">
            <div class="col-md-12">
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

</form>

@push('scripts')
<script type="text/javascript">
    $('.selectize').selectize();
</script>
@endpush