@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Adviser List')

@section('content_header')
    <h2 class="pl-1">Adviser List</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdviser"><i class="fas fa-fw fa-user-plus"></i> Add Adviser</button>
                    <div class="modal fade" id="modalAdviser{{ $adviser->id ?? null }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalAdviser{{ $adviser->id ?? null }}Label">Adviser Form</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-row" action="{{ route('adviser-store') }}" method="POST">
                                    @csrf
                                    <div class="form-group col-md-12">
                                        <label for="adviserName{{ $adviser->id ?? null }}">Adviser</label>
                                        <input type="text" name="name" class="form-control" onkeypress="acceptOnlyLetters(event)" id="adviserName{{ $adviser->id ?? null }}" value="{{ old('name', $adviser->name ?? null) }}" required>
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
                                        <label for="section_id">Section</label>
                                        <select name="section_id" class="custom-select" id="section_id">
                                            <option selected disabled>Select here...</option>
                                            @forelse ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="advisers-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($advisers as $adviser)
                            <tr>
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="#" data-toggle="modal" data-target="#modalAdviser{{ $adviser->id }}">{{ $adviser->name }}</a></strong>
                                    <div class="modal fade" id="modalAdviser{{ $adviser->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modalAdviser{{ $adviser->id ?? null }}Label">Adviser Form</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-row" action="{{ route('adviser-update', ['adviser' => $adviser->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group col-md-12">
                                                        <label for="adviserName{{ $adviser->id ?? null }}">Adviser Name</label>
                                                        <input type="text" name="name" class="form-control" id="adviserName{{ $adviser->id }}" value="{{ old('name', $adviser->name ?? null) }}" required>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="grade_no{{ $adviser->id }}">Grade No</label>
                                                        <select name="grade_no{{ $adviser->id }}" class="custom-select" id="grade_no{{ $adviser->id }}">
                                                            <option selected disabled>Select here...</option>
                                                            @forelse ($grades as $grade)
                                                                <option value="{{ $grade['grade_no'] }}" {{ $adviser->grade_no == $grade['grade_no'] ? 'selected' : null }}>{{ $grade['grade_name'] }}</option>
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="section_id{{ $adviser->id }}">Section</label>
                                                        <select name="section_id{{ $adviser->id }}" class="custom-select" id="section_id{{ $adviser->id }}">
                                                            <option selected disabled>Select here...</option>
                                                            @forelse ($sections as $section)
                                                                <option value="{{ $section->id }}" {{ $adviser->section_id }}>{{ $section->section_name }}</option>
                                                            @empty
                                                                
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                
                                </td>
                                <td>{{ $adviser->grade_no }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#adviserModalDelete{{ $adviser->id }}"><i class="fas fa-trash"></i></button>
                                    <div class="modal fade" id="adviserModalDelete{{ $adviser->id ?? null }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Delete Adviser Confirmation</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('adviser-delete', ['adviser' => $adviser->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $adviser->id }}">
                                                <p>Are you sure you want to delete this adviser from the record?</p>
                                                <p>Adviser: <strong>{{ $adviser->name }}</strong></p>
                                                <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
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
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script>
        $(document).ready(function () {
            $('#advisers-table').DataTable({
                "order": [],
            });
            
        });
    </script>
@stop
