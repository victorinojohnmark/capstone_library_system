@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Borrower List')

@section('content_header')
    <h2 class="pl-1">Update Borrower</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <a href="{{ route('borrower-index') }}" class="btn btn-primary"><i class="fas fa-fw fa-users"></i> Back to List</a>
                </div>
            </div>

            <div class="card-body">
                <form class="form-row" action="{{ route('borrower-update', ['borrower' => $borrower->id]) }}" method="POST" enctype="multipart/form-data">
                @include('master.borrowers.borrowerform')
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    @vite(['public/css/custom.css'])
    <link rel="stylesheet" href="/vendor/datatables/datatables.min.css">
@stop

@push('css')
    
@endpush

@section('js')
    <script src="/vendor/datatables/datatables.min.js"></script>
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
    </script>
    {{-- <script>
            // Function to toggle the visibility and required status of fields based on the selected type
            function toggleFieldsBasedOnType() {
                console.log('toggle')
                var typeSelect = document.getElementById('type');
                var lrnInput = document.getElementById('lrn');
                var gradeNoSelect = document.getElementById('grade_no');
                var sectionSelect = document.getElementById('section');
                var adviserSelect = document.getElementById('adviser');

                var selectedType = typeSelect.value;

                // Disable and clear LRN, Grade No, Section, and Adviser inputs
                lrnInput.disabled = true;
                // lrnInput.value = '';
                gradeNoSelect.disabled = true;
                // gradeNoSelect.value = '';
                sectionSelect.disabled = true;
                // sectionSelect.innerHTML = '';
                adviserSelect.disabled = true;
                // adviserSelect.innerHTML = '';

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
    </script> --}}
@stop
