<div class="panel panel-default">
    <div class="panel-body">

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