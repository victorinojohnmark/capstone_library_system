@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Section List')

@section('content_header')
    <h2 class="pl-1">Section List</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSection"><i class="fas fa-fw fa-user-plus"></i> Add Section</button>
                    <div class="modal fade" id="modalSection{{ $section->id ?? null }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalSection{{ $section->id ?? null }}Label">Section Form</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-row" action="{{ route('section-store') }}" method="POST">
                                    @csrf
                                    <div class="form-group col-md-12">
                                        <label for="sectionName{{ $section->id ?? null }}">Section</label>
                                        <input type="text" name="section_name" class="form-control" id="sectionName{{ $section->id ?? null }}" value="{{ old('section_name', $section->section_name ?? null) }}" required>
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
                <table id="sections-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($sections as $section)
                            <tr>
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="#" data-toggle="modal" data-target="#modalSection{{ $section->id }}">{{ $section->section_name }}</a></strong>
                                    <div class="modal fade" id="modalSection{{ $section->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modalSection{{ $section->id ?? null }}Label">Section Form</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-row" action="{{ route('section-update', ['section' => $section->id]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group col-md-12">
                                                        <label for="sectionName{{ $section->id ?? null }}">Section</label>
                                                        <input type="text" name="section_name" class="form-control" id="sectionName{{ $section->id }}" value="{{ old('section_name', $section->section_name ?? null) }}" required>
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
            $('#sections-table').DataTable({
                "order": [],
            });
            
        });
    </script>
@stop
