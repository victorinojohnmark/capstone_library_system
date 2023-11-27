<div class="modal fade" id="deleteAnnouncementModal{{ $announcement->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title">Delete Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('announcements.destroy', ['announcement' => $announcement->id]) }}">
            @csrf
            @method('DELETE')
        
            <p>Are you sure you want to delete this announcement?</p>
        
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-fw fa-trash"></i> Delete
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>