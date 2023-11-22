<div class="modal fade" id="approveBookRequest{{ $bookRequest->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Approved Book Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.book-requests-approve', ['bookRequest' => $bookRequest->id]) }}" method="POST">
                @csrf
                <p>Are you sure you want to approved the book request?</p>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#approveBookRequest{{ $bookRequest->id ?? null }}">
                    <i class="fas fa-fw fa-check"></i> Confirm
                </button>
            </form>
        </div>
      </div>
    </div>
  </div>