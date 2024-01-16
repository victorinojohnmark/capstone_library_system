
    @csrf
    <input type="hidden" name="id" value="{{ $borrower->id ?? null }}">
    <div class="col-md-2">
        <div class="form-group p-3">
            <img src="{{ $borrower->id ? $borrower->profileImageUrl : '/img/img-placeholder.jpg' }}" class="img-fluid" id="profilePicture" alt="">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="image_filename" class="form-control-file" id="profile_picture" onchange="handleImageChange(this, 'profilePicture')">
        </div>
    </div>

    <div class="row col-md-10">
        <div class="form-group col-md-6">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastName" value="{{ old('lastname', $borrower->lastname ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-6">
            <label for="firstName">First Name</label>
            <input type="text" name="firstname" class="form-control" id="firstName" value="{{ old('firstname', $borrower->firstname ?? null) }}" required>
        </div>
    
        {{-- <div class="form-group col-md-4">
            <label for="middleInitial">Middle Initial</label>
            <input type="text" name="middle_initial" class="form-control" id="middleInitial" value="{{ old('middle_initial') }}">
        </div> --}}

        <div class="form-group col-md-4">
            <label for="type">Type</label>
            <select name="type" class="custom-select" id="type">
                <option selected disabled>Select here...</option>
                @forelse ($types as $type)
                    <option value="{{ $type['name'] }}" {{ $borrower->type == $type['name'] ? 'selected' : null }}>{{ $type['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
  
        <div class="form-group col-md-4">
            <label for="lrn">LRN</label>
            <input type="number" name="lrn" class="form-control" id="lrn" value="{{ old('lrn', $borrower->lrn ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-4">
            <label for="grade_no">Grade No</label>
            <select name="grade_no" class="custom-select" id="grade_no">
                <option selected disabled>Select here...</option>
                @forelse ($grades as $grade)
                    <option value="{{ $grade['grade_no'] }}" {{ $borrower->grade_no == $grade['grade_no'] ? 'selected' : null }}>{{ $grade['grade_name'] }}</option>
                @empty
                    
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-4">
            <label for="section">Section</label>
            <select name="section_id" class="custom-select" id="section">
                <option selected disabled>Select here...</option>
                @forelse ($sections as $section)
                    <option value="{{ $section->id }}" {{ $borrower->section_id == $section->id ? 'selected' : null }}>{{ $section->section_name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        
    
        <div class="form-group col-md-8">
            <label for="adviser">Adviser</label>
            <select name="adviser_id" class="custom-select" id="adviser">
                <option selected disabled>Select here...</option>
                @forelse ($advisers as $adviser)
                    <option value="{{ $adviser->id }}" {{ $borrower->adviser_id == $adviser->id ? 'selected' : null }}>{{ $adviser->name }}</option>
                @empty
                @endforelse
            </select>
            
        </div>

        <hr>

        <div class="col-md-12">
            <div class="card bg-light rounded shadow-xs">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $borrower->email ?? null) }}" {{ $borrower->id? 'readonly disabled' : null }}>
                        </div>

                        {{-- @if (is_null($borrower->id)) --}}
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" value="{{ old('password_confirmation') }}">
                        </div>
                        {{-- @endif --}}
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>



{{-- <form class="form-row" action="/admin/borrowers{{ $borrower->id ? '/' . $borrower->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4">
        <div class="form-group p-3">
            <img src="{{ $borrower->id ? $borrower->profileImageUrl : '/img/img-placeholder.jpg' }}" class="img-fluid" id="profilePicture{{ $borrower->id ?? null }}" alt="">
            <label for="profile_picture{{ $borrower->id ?? null }}">Profile Picture</label>
            <input type="file" name="image_filename" class="form-control-file" id="profile_picture{{ $borrower->id ?? null }}" onchange="handleImageChange(this, 'profilePicture{{ $borrower->id ?? null }}')">
        </div>
    </div>

    <div class="row col-md-8">
        <div class="form-group col-md-12">
            <label for="lastName{{ $borrower->id ?? null }}">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastName{{ $borrower->id ?? null }}" value="{{ old('lastname', $borrower->lastname ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-8">
            <label for="firstName{{ $borrower->id ?? null }}">First Name</label>
            <input type="text" name="firstname" class="form-control" id="firstName{{ $borrower->id ?? null }}" value="{{ old('firstname', $borrower->lastname ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-4">
            <label for="middleInitial{{ $borrower->id ?? null }}">Middle Initial</label>
            <input type="text" name="middle_initial" class="form-control" id="middleInitial{{ $borrower->id ?? null }}" value="{{ old('middle_initial', $borrower->middle_initial ?? null) }}">
        </div>
    
        <div class="form-group col-md-4">
            <label for="lrn{{ $borrower->id ?? null }}">LRN</label>
            <input type="text" name="lrn" class="form-control" id="lrn{{ $borrower->id ?? null }}" value="{{ old('lrn', $borrower->lrn ?? null) }}">
        </div>
    
        <div class="form-group col-md-4">
            <label for="grade{{ $borrower->id ?? null }}">Grade</label>
            <select name="grade" class="custom-select" id="grade{{ $borrower->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($grades as $grade)
                    <option value="{{ $grade['grade_name'] }}" {{ $borrower->id ? $borrower->grade == $grade['grade_name'] ? 'selected' : null : null  }} >{{ $grade['grade_name'] }}</option>
                @empty
                    
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-4">
            <label for="section{{ $borrower->id ?? null }}">Section</label>
            <select name="section_id" class="custom-select" id="section{{ $borrower->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($sections as $section)
                    <option value="{{ $section->id }}" {{ $borrower->id ? $borrower->section_id == $section->id ? 'selected' : null : null  }} >{{ $section->section_name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="type{{ $borrower->id ?? null }}">Type</label>
            <select name="type" class="custom-select" id="type{{ $borrower->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($types as $type)
                    <option value="{{ $type['name'] }}" {{ $borrower->id ? $borrower->type == $type['name'] ? 'selected' : null : null  }} >{{ $type['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-8">
            <label for="adviser{{ $borrower->id ?? null }}">Adviser</label>
            <select name="adviser_id" class="custom-select" id="adviser{{ $borrower->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($advisers as $adviser)
                    <option value="{{ $adviser->id }}" {{ $borrower->id ? $borrower->adviser_id == $adviser->id ? 'selected' : null : null  }} >{{ $adviser->name }}</option>
                @empty
                @endforelse
            </select>
            
        </div>

        <hr>

        <div class="col-md-12">
            <div class="card bg-light rounded shadow-xs">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email{{ $borrower->id ?? null }}">Email</label>
                            <input type="email" name="email" class="form-control" id="email{{ $borrower->id ?? null }}" value="{{ old('email', $borrower->email ?? null) }}" required>
                        </div>

                        @if (!$borrower->id)
                            <div class="form-group col-md-6">
                                <label for="password{{ $borrower->id ?? null }}">Password</label>
                                <input type="password" name="password" class="form-control" id="password{{ $borrower->id ?? null }}" value="{{ old('password', $borrower->password ?? null) }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="passwordConfirmation{{ $borrower->id ?? null }}">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation{{ $borrower->id ?? null }}" value="{{ old('password_confirmation') }}" required>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

    
    
</form> --}}