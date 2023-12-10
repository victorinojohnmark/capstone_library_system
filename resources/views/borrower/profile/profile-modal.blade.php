<div class="modal fade" id="modalProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Profile Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-row" action="{{ route('borrower.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <div class="form-group p-3">
                        <img src="{{ $user->profile_image_url ?? '/img/img-placeholder.jpg' }}" class="img-fluid" id="profilePicture" alt="">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" name="image_filename" class="form-control-file" id="profile_picture" onchange="handleImageChange(this, 'profilePicture')">
                    </div>
                </div>
            
                <div class="row col-md-8">
                    <div class="form-group col-md-12">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="lastName" value="{{ old('lastname', $user->lastname) }}" required>
                    </div>
                
                    <div class="form-group col-md-8">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="firstName" value="{{ old('firstname', $user->firstname) }}" required>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="middleInitial">Middle Initial</label>
                        <input type="text" name="middle_initial" class="form-control" id="middleInitial" value="{{ old('middle_initial', $user->middle_initial) }}">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="lrn">LRN</label>
                        <input type="text" name="lrn" class="form-control" id="lrn" value="{{ old('lrn', $user->lrn) }}">
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="grade">Grade</label>
                        <select name="grade" class="custom-select" id="grade">
                            <option selected disabled>Select here...</option>
                            @forelse ($grades as $grade)
                                <option value="{{ $grade['grade_name'] }}" {{ $user->grade == $grade['grade_name'] ? 'selected' : null }}>{{ $grade['grade_name'] }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="section">Section</label>
                        <select name="section_id" class="custom-select" id="section">
                            <option selected disabled>Select here...</option>
                            @forelse ($sections as $section)
                                <option value="{{ $section->id }}" {{ $user->section_id == $section->id ? 'selected' : null }}>{{ $section->section_name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
            
                    <div class="form-group col-md-4">
                        <label for="type">Type</label>
                        <select name="type" class="custom-select" id="type">
                            <option selected disabled>Select here...</option>
                            @forelse ($types as $type)
                                <option value="{{ $type['name'] }}" {{ $user->type == $type['name'] ? 'selected' : null }}>{{ $type['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                
                    <div class="form-group col-md-8">
                        <label for="adviser">Adviser</label>
                        <select name="adviser_id" class="custom-select" id="adviser">
                            <option selected disabled>Select here...</option>
                            @forelse ($advisers as $adviser)
                                <option value="{{ $adviser->id }}" {{ $user->adviser_id == $adviser->id ? 'selected' : null }}>{{ $adviser->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        
                    </div>
            
                    <hr>
            
                    {{-- <div class="col-md-12">
                        <div class="card bg-light rounded shadow-xs">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                    </div>
            
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" required>
                                    </div>
        
                                    <div class="form-group col-md-6">
                                        <label for="passwordConfirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" value="{{ old('password_confirmation') }}" required>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> --}}
            
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            
                
                
            </form>
        </div>
      </div>
    </div>
</div>