<div class="list-group border-0 mb-5">
    <a href="{{ route('borrower.home') }}" class="list-group-item list-group-item-action{{ Route::currentRouteName() === 'borrower.home' ? ' active' : '' }}">Dashboard</a>
    <a href="#" class="list-group-item list-group-item-action">My Notifications</a>
    <a href="{{ route('borrower.book-requests') }}" class="list-group-item list-group-item-action{{ Route::currentRouteName() === 'borrower.book-requests' ? ' active' : '' }}">My Book Requests</a>
</div>