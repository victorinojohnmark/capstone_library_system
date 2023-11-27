<form class="form-row" action="/admin/announcements{{ $announcement->id ? '/' . $announcement->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($announcement->id)
        <input type="hidden" name="_method" value="PATCH">
    @endif
    <div class="form-group col-md-12">
        <label for="title{{ $announcement->id ?? null }}">Title</label>
        <input type="text" name="title" class="form-control" id="title{{ $announcement->id ?? null }}" value="{{ old('title', $announcement->title ?? null) }}" required>
    </div>

    <div class="form-group col-md-12">
        <label for="description{{ $announcement->id ?? null }}">Description</label>
        <textarea name="description" class="form-control tinymce-editor" id="description{{ $announcement->id ?? null }}" cols="30" rows="10">{{ old('description', $announcement->description ?? null) }}</textarea>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
        @if ($announcement->id)
            <a href="{{ route('announcements.index') }}" class="btn btn-danger">Cancel</a>
        @endif
    </div>
    
</form>