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
                        <span class="input-group-addon" id="basic-addon1">my-site.dev/</span>                
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