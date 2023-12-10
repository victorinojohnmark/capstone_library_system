@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Profile')

@section('content_header')
    <h2>Profile</h2>
@stop

@section('content')
@include('layouts.message')
<div class="card">
    <div class="card-body">
        <div class="card-title mb-4">
            <div class="d-flex justify-content-start">
                <div class="image-container">
                    <img src="{{ $user->profile_image_url ?? '/img/user-avatar.png' }}" id="imgProfile" style="width: 150px; height: 150px"
                        class="img-thumbnail" />
                    
                </div>
                <div class="userData ml-3 mt-5">
                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{!! $user->firstname !!} {!! $user->lastname !!}</h2>
                    @if ($user->lrn)
                    <h6 class="d-block">{!! $user->lrn !!}</h6>
                    @endif
                </div>
                {{-- <div class="ml-auto">
                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                </div> --}}
            </div>
            <div class="middle">
                <button type="button" data-toggle="modal" data-target="#modalProfile" class="btn btn-success btn-sm mt-1">Update Profile</button>
                @include('borrower.profile.profile-modal')

                <a href="{{ route('password.request') }}" class="btn btn-primary btn-sm mt-1">Reset Password</a>
                {{-- <input type="file" style="display: none;" id="profilePicture" name="file" /> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab"
                            aria-controls="basicInfo" aria-selected="true">Information</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices"
                            role="tab" aria-controls="connectedServices" aria-selected="false">Connected Services</a>
                    </li> --}}
                </ul>
                <div class="tab-content ml-1" id="myTabContent">
                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                        aria-labelledby="basicInfo-tab">


                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Full Name</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->name !!}
                            </div>
                        </div>
                        <hr />

                        @if ($user->grade)
                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Grade</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->grade !!}
                            </div>
                        </div>
                        @endif
                        <hr />

                        @if ($user->section_id)
                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Section</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->section->section_name !!}
                            </div>
                        </div>
                        @endif
                        <hr />

                        @if ($user->adviser_id)
                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Adviser</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->adviser->name !!}
                            </div>
                        </div>
                        @endif
                        <hr />


                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Type</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->type !!}
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Registration Date</label>
                            </div>
                            <div class="col-md-8 col-6">
                                {!! $user->created_at->format('Y-m-d') !!}
                            </div>
                        </div>
                        <hr />
                    </div>
                    {{-- <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                        aria-labelledby="ConnectedServices-tab">
                        Facebook, Google, Twitter Account that are connected to this account
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/datatables/datatables.min.css">
@stop

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/datatables/datatables.min.js"></script>
    <script src="/js/custom.js"></script>
@stop
