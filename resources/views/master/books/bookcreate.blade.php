@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Form')

@section('content_header')
    <h2 class="pl-1">Books</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <a href="{{ route('book-index') }}" class="btn btn-primary"><i class="fas fa-fw fa-book"></i> Back to Book List</a>
                </div>
            </div>

            <div class="card-body">
                @include('master.books.bookform')
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    @vite(['public/css/custom.css'])
    <link rel="stylesheet" href="{{ asset('vendor/tagsinput/tagsinput.css') }}">
@stop

@push('css')
    
@endpush

@section('js')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/tagsinput/tagsinput.js') }}"></script>
<script>
    // Function to handle category change
    function handleCategoryChange(selectElement) {
        var subjectInput = document.getElementById('subject');
        // var isbnInput = document.getElementById('isbn');

        // Check if the selected category is 'Book'
        if (selectElement.value === 'Books') {
            // Enable the subject input
            subjectInput.removeAttribute('disabled');
            // isbnInput.removeAttribute('disabled');
        } else {
            // Disable the subject input and reset its value
            subjectInput.setAttribute('disabled', 'disabled');
            subjectInput.value = '';

            // isbnInput.setAttribute('disabled', 'disabled');
            // isbnInput.value = '';
        }
    }

    // Trigger the function onload to set the initial state
    document.addEventListener("DOMContentLoaded", function () {
        handleCategoryChange(document.getElementById('category'));
    });
</script>
@stop
