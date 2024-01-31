
    @csrf
    <input type="hidden" name="id" value="{{ $borrower->id ?? null }}">
    <div class="col-md-2">
        <div class="form-group p-3">
            <img src="{{ $borrower->id ? $borrower->profileImageUrl : '/img/user.jpg' }}" class="img-fluid" id="profilePicture" alt="">
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

        <div class="form-group col-md-4">
            <label for="type">Type</label>
            <select name="type" class="custom-select" id="type">
                <option selected disabled>Select here...</option>
                @forelse ($types as $type)
                    <option value="{{ $type['name'] }}" {{ $borrower->type == $type['name'] ? 'selected' : null }} {{ old('type') == $type['name'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
  
        <div class="form-group col-md-4 studentField">
            <label for="lrn">LRN</label>
            <input type="number" name="lrn" class="form-control" id="lrn" oninput="validateInput(this)" value="{{ old('lrn', $borrower->lrn ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-4 studentField">
            <label for="grade_no">Grade No</label>
            <select name="grade_no" class="custom-select" id="grade_no">
                <option selected disabled>Select here...</option>
                @forelse ($grades as $grade)
                    <option value="{{ $grade['grade_no'] }}" {{ $borrower->grade_no == $grade['grade_no'] ? 'selected' : null }} {{ old('grade_no') == $grade['grade_no'] ? 'selected' : '' }}>{{ $grade['grade_name'] }}</option>
                @empty
                    
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-4 studentField">
            <label for="section">Section</label>
            <select name="section_id" class="custom-select" id="section">
                <option selected disabled>Select here...</option>
                @forelse ($sections as $section)
                    <option value="{{ $section->id }}" {{ $borrower->section_id == $section->id ? 'selected' : null }} {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->section_name }}</option>
                @empty
                @endforelse
            </select>
        </div>  
    
        <div class="form-group col-md-8 studentField">
            <label for="adviser">Adviser</label>
            <select name="adviser_id" class="custom-select" id="adviser">
                <option selected disabled>Select here...</option>
                @forelse ($advisers as $adviser)
                    <option value="{{ $adviser->id }}" {{ $borrower->adviser_id == $adviser->id ? 'selected' : null }} {{ old('adviser_id') == $adviser->id ? 'selected' : '' }}>{{ $adviser->name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="form-group col-md-4 facultyField">
            <label for="employee_no">Employee No</label>
            <input type="number" name="employee_no" class="form-control" id="employee_no" pattern="\d{12}" oninput="validateInput(this)" value="{{ old('employee_no', $borrower->employee_no ?? null) }}" required>
        </div>

        <div class="form-group col-md-4 facultyField">
            <label for="department">Department</label>
            <select name="department_id" class="custom-select" id="department">
                <option selected disabled>Select here...</option>
                @forelse ($departments as $department)
                    <option value="{{ $department->id }}" {{ $borrower->department_id == $department->id ? 'selected' : null }} {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->department_name }}</option>
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

                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" value="{{ old('password_confirmation') }}">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>