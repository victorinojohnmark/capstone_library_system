<div class="card rounded-0 shadow-sm mb-3 text-left" id="accordionAnnouncement">
    <div class="card-header px-4">
        <h6 class="mb-0 font-weight-bold">Announcements</h6>
    </div>
    @forelse ($announcements as $announcement)
        <div class="card-header px-4 text-left" id="headingAnnouncement{{ $announcement->id }}">
            <a href="#" class="block w-100 text-left text-decoration-none font-bold" style="font-size: 13px;" data-toggle="collapse" data-target="#collapseAnnouncement{{ $announcement->id }}">
                {{ $announcement->title }}
            </a>
        </div>

        <div id="collapseAnnouncement{{ $announcement->id }}" class="collapse">
            <div class="card-body">
                {{ $announcement->description }}
            </div>
        </div>  
            
    @empty
        <p>No posted Announcements.</p>
    @endforelse    
    
</div>