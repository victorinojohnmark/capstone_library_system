@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Settings')

@section('content_header')
    <h2 class="pl-1">Settings</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    
                </div>
            </div>

            <div class="card-body">
               <form class="form-row" action="{{ route('setting.update') }}" method="post">
                @csrf

                <div class="form-group col-md-6">
                    <label for="mission">Mission</label>
                    <textarea name="mission" class="form-control" id="mission" cols="30" rows="7">{{ old('mission', $appSetting->mission ?? null) }}</textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="vision">Vission</label>
                    <textarea name="vision" class="form-control" id="vision" cols="30" rows="7">{{ old('vision', $appSetting->mission ?? null) }}</textarea>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>

                <hr>

                <h6>Gallery</h6>

                <div class="row">
                    <div class="col-sm-1 col-md-2">
                        <img src="https://placehold.co/400x400?text=%2B" role="button" style="object-fit: cover; aspect-ratio: 2/2" data-toggle="modal" data-target="#imageModal" class="img-thumbnail" alt="..." >

                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('setting.addGalleryImage') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="imageFile">Image File</label>
                                            <input type="file" name="file[]" class="form-control-file" id="imageFile" multiple accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                    @forelse ($galleries as $gallery)
                    <div class="col-sm-1 col-md-2">
                        <div class="relative">
                            <button class="btn btn-xs btn-danger position-absolute px-2" style="top: 8px; right: 15px;" data-toggle="modal" data-target="#deleteImageModal{{ $gallery->id }}"><i class="fas fa-times"></i></button>
                            <img src="{!! '/storage/gallery/'. $gallery->file !!}" class="img-thumbnail" style="object-fit: cover; aspect-ratio: 2/2"  alt="...">
                            <div class="modal fade" id="deleteImageModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="deleteImageModal{{ $gallery->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deleteImageModal{{ $gallery->id }}Label">Upload Image</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ route('setting.deleteGalleryImage', ['gallery' => $gallery->id]) }}" method="post" >
                                        @csrf
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this image?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-sm-1 col-md-2">
                        <img src="https://placehold.co/400x400?text=Missing+Image" class="img-thumbnail" style="object-fit: cover; aspect-ratio: 2/2" alt="...">
                    </div>
                    @endforelse

                    

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    @vite(['public/css/custom.css'])
    {{-- <link rel="stylesheet" href="/vendor/datatables/datatables.min.css"> --}}
@stop

@push('css')
    
@endpush

@section('js')
    {{-- <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script> --}}
    <script src="{{ asset('js/custom.js') }}"></script>
@stop
