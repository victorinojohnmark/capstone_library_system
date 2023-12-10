<div class="card rounded-0 shadow-sm mb-3 text-left" id="accordionAnnouncement">
    <div class="card-header px-4">
        <h6 class="mb-0 font-weight-bold">Announcements</h6>
    </div>
    @forelse ($announcements as $announcement)
        <div class="card-header px-4 text-left" id="headingAnnouncement{{ $announcement->id }}">
            <a href="#" class="block w-100 text-left text-decoration-none font-bold" style="font-size: 13px;" data-toggle="modal" data-target="#announcementModal{{ $announcement->id }}">
                {!! $announcement->title !!}
            </a>
        </div>

        <div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Announcement</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body announcement">
                    <h3>{!! $announcement->title !!}</h3>
                    <p>{!! $announcement->description !!}</p>
                </div>
              </div>
            </div>
          </div>

        {{-- <div id="collapseAnnouncement{{ $announcement->id }}" class="collapse">
            <div class="card-body">
                {!! $announcement->description !!}
            </div>
        </div>   --}}
            
    @empty
        <p>No posted Announcements.</p>
    @endforelse    
    
</div>