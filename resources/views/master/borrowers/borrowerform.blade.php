<form class="form-row" action="#" method="POST" enctype="multipart/form-data">
    <div class="form-group col-md-4">
        <img src="/img/img-placeholder.jpg" class="img-fluid" id="profilePicture{{ $borrower->id ?? null }}" alt="">
        <label for="profile_picture{{ $borrower->id ?? null }}">Profile Picture</label>
        <input type="file" class="form-control-file" id="profile_picture{{ $borrower->id ?? null }}" onchange="handleImageChange(this, 'profilePicture{{ $borrower->id ?? null }}')">
    </div>

    <div class="form-group col-md-12">
        <label for="lastName{{ $borrower->id ?? null }}">Last Name</label>
        <input type="text" class="form-control" id="lastName{{ $borrower->id ?? null }}" value="{{ old('lastname', $borrower->lastname ?? null) }}" required>
    </div>

    <div class="form-group col-md-9">
        <label for="firstName{{ $borrower->id ?? null }}">First Name</label>
        <input type="text" class="form-control" id="firstName{{ $borrower->id ?? null }}" value="{{ old('firstname', $borrower->lastname ?? null) }}" required>
    </div>

    <div class="form-group col-md-3">
        <label for="middleInitial{{ $borrower->id ?? null }}">Middle Initial</label>
        <input type="text" class="form-control" id="middleInitial{{ $borrower->id ?? null }}" value="{{ old('middle_initial', $borrower->middle_initial ?? null) }}">
    </div>

    <div class="form-group col-md-3">
        <label for="lrn{{ $borrower->id ?? null }}">LRN</label>
        <input type="text" class="form-control" id="lrn{{ $borrower->id ?? null }}" value="{{ old('lrn', $borrower->lrn ?? null) }}">
    </div>

    {{-- <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> --}}
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
</form>