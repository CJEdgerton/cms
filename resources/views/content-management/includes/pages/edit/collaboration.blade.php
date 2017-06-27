<div class="panel panel-default">
    <div class="panel-body">

        <p class="lead text-center">
            Collaborate with other users.
        </p>

        {{-- <form action="{{ route('pages.add_collaborators', ['id' => $page->id]) }}" class="form-horizontal" method="POST"> --}}
        <form class="form-horizontal">
            <label class="control-label">Add Collaborators</label>
            <select name="" id="input" class="form-control" required="required">
                <option value=""></option>
                <option value="">Person</option>
                <option value="">Dog</option>
                <option value="">Cat</option>
            </select>
        </form>

    </div>
</div>