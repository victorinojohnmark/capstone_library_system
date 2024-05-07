@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    @include('layouts.message')
    <form class="form-row" action="{{ $register_url }}" method="POST" enctype="multipart/form-data">
        

        @csrf
        <div class="col-md-4">
            <div class="form-group p-3">
                <img src="/img/user.jpg" class="img-fluid" id="profilePicture" alt="">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="image_filename" class="form-control-file" id="profile_picture" onchange="handleImageChange(this, 'profilePicture')">
            </div>
        </div>
    
        <div class="row col-md-8">
            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastname" onkeypress="acceptOnlyLetters(event)" class="form-control" id="lastName" value="{{ old('lastname') }}" required>
            </div>
        
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" name="firstname" onkeypress="acceptOnlyLetters(event)" class="form-control" id="firstName" value="{{ old('firstname') }}" required>
            </div>

            <div class="form-group col-md-4 ">
                <label for="type">Type</label>
                <select name="type" class="custom-select" id="type">
                    <option selected disabled>Select here...</option>
                    @forelse ($types as $type)
                        <option value="{{ $type['name'] }}" {{ old('type') == $type['name'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        
            <div class="form-group col-md-4 studentField">
                <label for="lrn">LRN</label>
                <input type="number" name="lrn" class="form-control" id="lrn" oninput="validateInput(this)" value="{{ old('lrn') }}">
            </div>
        
            <div class="form-group col-md-4 studentField">
                <label for="grade_no">Grade No</label>
                <select name="grade_no" class="custom-select" id="grade_no">
                    <option selected disabled>Select here...</option>
                    @forelse ($grades as $grade)
                        <option value="{{ $grade['grade_no'] }}" {{ old('grade_no') == $grade['grade_no'] ? 'selected' : '' }}>{{ $grade['grade_name'] }}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>
        
            <div class="form-group col-md-4 studentField">
                <label for="section">Section</label>
                <select name="section_id" class="custom-select" id="section">
                    <option selected disabled>Select here...</option>
                    @forelse ($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->section_name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
    
            
        
            <div class="form-group col-md-8 studentField">
                <label for="adviser">Adviser</label>
                <select name="adviser_id" class="custom-select" id="adviser">
                    <option selected disabled>Select here...</option>
                    @forelse ($advisers as $adviser)
                        <option value="{{ $adviser->id }}" {{ old('adviser_id') == $adviser->id ? 'selected' : '' }}>{{ $adviser->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group col-md-4 facultyField">
                <label for="employee_no">Employee No</label>
                <input type="number" name="employee_no" class="form-control" id="employee_no" pattern="\d{12}" oninput="validateInput(this)" value="{{ old('employee_no') }}">
            </div>

            <div class="form-group col-md-4 facultyField">
                <label for="department">Department</label>
                <select name="department_id" class="custom-select" id="department">
                    <option selected disabled>Select here...</option>
                    @forelse ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->department_name }}</option>
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
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" oninput="validatePassword(event)" class="form-control" id="password" value="{{ old('password') }}" required>
                                <span class="error text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" oninput="validateConfirmPassword(event)" class="form-control" id="passwordConfirmation" value="{{ old('password_confirmation') }}" required>
                                <span class="error text-danger"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    
        
        
    </form>
@stop

@section('auth_footer')
    {{-- Login link --}}
    @if($login_url)
        <p class="my-0">
            <p>Have an account? 
                <a href="{{ $login_url }}">
                    <strong>Login</strong>    
                </a>
            </p>
            
        </p>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script src="/js/custom.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
            // Function to toggle the visibility and required status of fields based on the selected type
            function toggleFieldsBasedOnType() {
                var typeSelect = document.getElementById('type');
                var lrnInput = document.getElementById('lrn');
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');
                var departmentSelect = document.getElementById('department');
                var employeeNoInput = document.getElementById('employee_no');


                var studentFields = document.querySelectorAll('.studentField');
                var facultyFields = document.querySelectorAll('.facultyField');

                var selectedType = typeSelect.value;

                // Hide both fields initially
                studentFields.forEach(function(field) {
                    field.classList.add('d-none');
                });
                facultyFields.forEach(function(field) {
                    field.classList.add('d-none');
                });

                // Disable and clear LRN, Grade No, Section, and Adviser inputs
                // lrnInput.disabled = true;
                // lrnInput.value = '';

                // gradeNoSelect.disabled = true;
                // gradeNoSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // sectionSelect.disabled = true;
                // sectionSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // adviserSelect.disabled = true;
                // adviserSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // departmentSelect.disabled = true;
                // departmentSelect.selectedIndex = 0;

                // employeeNoInput.disabled = true;
                // employeeNoInput.value = '';

                if (selectedType === 'Student') {
                    // Enable and make LRN, Grade No, Section, and Adviser inputs required
                    lrnInput.disabled = false;
                    lrnInput.required = true;

                    gradeNoSelect.disabled = false;
                    gradeNoSelect.required = true;

                    sectionSelect.disabled = false;
                    sectionSelect.required = true;

                    adviserSelect.disabled = false;
                    adviserSelect.required = true;

                    departmentSelect.disabled = true;
                    departmentSelect.required = false;

                    employeeNoInput.disabled = true;
                    employeeNoInput.required = false;

                    // Show student fields
                    studentFields.forEach(function(field) {
                        field.classList.remove('d-none');
                    });


                    // Fetch grade list for students
                    fetch('/api/grades')
                        .then(response => response.json())
                        .then(data => {
                            // Populate grades based on the API response
                            gradeNoSelect.innerHTML = '<option selected disabled>Select here...</option>';
                            data.forEach(grade => {
                                gradeNoSelect.innerHTML += `<option value="${grade.grade_no}">${grade.grade_name}</option>`;
                            });
                        });
                } else if(selectedType === 'Faculty') {
                    // Enable and make LRN, Grade No, Section, and Adviser inputs required
                    lrnInput.disabled = true;
                    lrnInput.required = false;

                    gradeNoSelect.disabled = true;
                    gradeNoSelect.required = false;

                    sectionSelect.disabled = true;
                    sectionSelect.required = false;

                    adviserSelect.disabled = true;
                    adviserSelect.required = false;

                    departmentSelect.disabled = false;
                    departmentSelect.required = true;

                    employeeNoInput.disabled = false;
                    employeeNoInput.required = true;

                    // Show faculty field
                    facultyFields.forEach(function(field) {
                        field.classList.remove('d-none');
                    });

                } else {
                    // Disable and remove required for LRN, Grade No, Section, and Adviser inputs
                    lrnInput.required = false;
                    adviserSelect.required = false;
                    sectionSelect.required = false;
                    departmentSelect.required = false;
                    employeeNoInput.required = false;
                }
            }

            function toggleFieldsonInitialLoad() {
                var typeSelect = document.getElementById('type');
                var lrnInput = document.getElementById('lrn');
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');
                var departmentSelect = document.getElementById('department');
                var employeeNoInput = document.getElementById('employee_no');


                var studentFields = document.querySelectorAll('.studentField');
                var facultyFields = document.querySelectorAll('.facultyField');

                var selectedType = typeSelect.value;

                // Hide both fields initially
                studentFields.forEach(function(field) {
                    field.classList.add('d-none');
                });
                facultyFields.forEach(function(field) {
                    field.classList.add('d-none');
                });

                // Disable and clear LRN, Grade No, Section, and Adviser inputs
                // lrnInput.disabled = true;
                // lrnInput.value = '';

                // gradeNoSelect.disabled = true;
                // gradeNoSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // sectionSelect.disabled = true;
                // sectionSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // adviserSelect.disabled = true;
                // adviserSelect.innerHTML = '<option selected disabled>Select here...</option>';

                // departmentSelect.disabled = true;
                // departmentSelect.selectedIndex = 0;

                // employeeNoInput.disabled = true;
                // employeeNoInput.value = '';

                if (selectedType === 'Student') {
                    // Enable and make LRN, Grade No, Section, and Adviser inputs required
                    lrnInput.disabled = false;
                    lrnInput.required = true;

                    gradeNoSelect.disabled = false;
                    gradeNoSelect.required = true;

                    sectionSelect.disabled = false;
                    sectionSelect.required = true;

                    adviserSelect.disabled = false;
                    adviserSelect.required = true;

                    departmentSelect.disabled = true;
                    departmentSelect.required = false;

                    employeeNoInput.disabled = true;
                    employeeNoInput.required = false;

                    // Show student fields
                    studentFields.forEach(function(field) {
                        field.classList.remove('d-none');
                    });
                } else if(selectedType === 'Faculty') {
                    // Enable and make LRN, Grade No, Section, and Adviser inputs required
                    lrnInput.disabled = true;
                    lrnInput.required = false;

                    gradeNoSelect.disabled = true;
                    gradeNoSelect.required = false;

                    sectionSelect.disabled = true;
                    sectionSelect.required = false;

                    adviserSelect.disabled = true;
                    adviserSelect.required = false;

                    departmentSelect.disabled = false;
                    departmentSelect.required = true;

                    employeeNoInput.disabled = false;
                    employeeNoInput.required = true;

                    // Show faculty field
                    facultyFields.forEach(function(field) {
                        field.classList.remove('d-none');
                    });

                } else {
                    // Disable and remove required for LRN, Grade No, Section, and Adviser inputs
                    lrnInput.required = false;
                    adviserSelect.required = false;
                    sectionSelect.required = false;
                    departmentSelect.required = false;
                    employeeNoInput.required = false;
                }
            }

            // Attach event listener to the "Type" select input
            var typeSelect = document.getElementById('type');
            typeSelect.addEventListener('change', toggleFieldsBasedOnType);

            // Trigger the function on page load to set the initial state
            toggleFieldsonInitialLoad();

            // Function to populate Section and Adviser based on Grade No
            function populateSectionsAndAdvisers() {
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');

                var selectedGradeNo = gradeNoSelect.value;

                console.log(gradeNoSelect.value);

                // Make API requests to get sections and advisers based on the selected grade
                if (selectedGradeNo) {
                    fetch(`/api/sections?grade_no=${selectedGradeNo}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate sections based on the API response
                            sectionSelect.innerHTML = '<option selected disabled>Select here...</option>';
                            data.forEach(section => {
                                sectionSelect.innerHTML += `<option value="${section.id}">${section.section_name}</option>`;
                            });
                        });

                    fetch(`/api/advisers?grade_no=${selectedGradeNo}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate advisers based on the API response
                            adviserSelect.innerHTML = '<option selected disabled>Select here...</option>';
                            data.forEach(adviser => {
                                adviserSelect.innerHTML += `<option value="${adviser.id}">${adviser.name}</option>`;
                            });
                        });
                }
            }

            // Attach event listener to the "Grade No" select input
            var gradeNoSelect = document.getElementById('grade_no');
            gradeNoSelect.addEventListener('change', populateSectionsAndAdvisers);
        // });

        function validateInput(input) {
            const inputValue = input.value;

            // Remove non-digit characters
            const numericValue = inputValue.replace(/\D/g, '');

            // Limit to 12 digits
            const limitedValue = numericValue.slice(0, 12);

            // Update the input value
            input.value = limitedValue;
        }

        var targetElement = document.querySelector('.register-logo > a > :nth-child(2)');
  
        // Change the innerHTML
        if (targetElement) {
        targetElement.innerHTML = 'Web-based Library System of Amaya School of Home Industries';
        }
    </script>

    
@stop
