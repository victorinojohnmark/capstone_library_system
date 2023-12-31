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
                                        <input type="text" name="name" class="form-control" id="adviserName{{ $adviser->id ?? null }}" value="{{ old('name', $adviser->name ?? null) }}" required>
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
            $('#advisers-table').DataTable({
                "order": [],
            });
            
        });
    </script>
@stop
