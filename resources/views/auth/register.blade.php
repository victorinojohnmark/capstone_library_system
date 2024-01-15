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

    <form class="form-row" action="{{ $register_url }}" method="POST" enctype="multipart/form-data">
        @include('layouts.message')

        @csrf
        <div class="col-md-4">
            <div class="form-group p-3">
                <img src="/img/img-placeholder.jpg" class="img-fluid" id="profilePicture" alt="">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="image_filename" class="form-control-file" id="profile_picture" onchange="handleImageChange(this, 'profilePicture')">
            </div>
        </div>
    
        <div class="row col-md-8">
            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastname" class="form-control" id="lastName" value="{{ old('lastname') }}" required>
            </div>
        
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" name="firstname" class="form-control" id="firstName" value="{{ old('firstname') }}" required>
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
                        <option value="{{ $type['name'] }}">{{ $type['name'] }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        
            <div class="form-group col-md-4">
                <label for="lrn">LRN</label>
                <input type="number" name="lrn" class="form-control" id="lrn" value="{{ old('lrn') }}">
            </div>
        
            <div class="form-group col-md-4">
                <label for="grade_no">Grade No</label>
                <select name="grade_no" class="custom-select" id="grade_no">
                    <option selected disabled>Select here...</option>
                    @forelse ($grades as $grade)
                        <option value="{{ $grade['grade_no'] }}">{{ $grade['grade_name'] }}</option>
                    @empty
                        
                    @endforelse
                </select>
            </div>
        
            <div class="form-group col-md-4">
                <label for="section">Section</label>
                <select name="section_id" class="custom-select" id="section">
                    <option selected disabled>Select here...</option>
                    @forelse ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
    
            
        
            <div class="form-group col-md-8">
                <label for="adviser">Adviser</label>
                <select name="adviser_id" class="custom-select" id="adviser">
                    <option selected disabled>Select here...</option>
                    @forelse ($advisers as $adviser)
                        <option value="{{ $adviser->id }}" >{{ $adviser->name }}</option>
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
                                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" value="{{ old('password_confirmation') }}" required>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Function to toggle the visibility and required status of fields based on the selected type
            function toggleFieldsBasedOnType() {
                var typeSelect = document.getElementById('type');
                var lrnInput = document.getElementById('lrn');
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');

                var selectedType = typeSelect.value;

                // Disable and clear LRN, Grade No, Section, and Adviser inputs
                lrnInput.disabled = true;
                lrnInput.value = '';
                gradeNoSelect.disabled = true;
                gradeNoSelect.value = '';
                sectionSelect.disabled = true;
                sectionSelect.innerHTML = '<option selected disabled>Select here...</option>';
                adviserSelect.disabled = true;
                adviserSelect.innerHTML = '<option selected disabled>Select here...</option>';

                if (selectedType === 'Student') {
                    // Enable and make LRN, Grade No, Section, and Adviser inputs required
                    lrnInput.disabled = false;
                    lrnInput.required = true;
                    gradeNoSelect.disabled = false;
                    gradeNoSelect.required = true;
                    sectionSelect.disabled = false;
                    adviserSelect.disabled = false;
                } else {
                    // Disable and remove required for LRN, Grade No, Section, and Adviser inputs
                    lrnInput.required = false;
                }
            }

            // Attach event listener to the "Type" select input
            var typeSelect = document.getElementById('type');
            typeSelect.addEventListener('change', toggleFieldsBasedOnType);

            // Trigger the function on page load to set the initial state
            toggleFieldsBasedOnType();

            // Function to populate Section and Adviser based on Grade No
            function populateSectionsAndAdvisers() {
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');

                var selectedGradeNo = gradeNoSelect.value;

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
        });
    </script>
@stop
