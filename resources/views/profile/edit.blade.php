@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h4 class="mb-4 fw-bold text-dark">
        Profile
    </h4>

    <div class="card mb-3 shadow-sm border-0">
        <div class="card-body text-dark bg-white">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-3 shadow-sm border-0">
        <div class="card-body text-dark bg-white">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body text-dark bg-white">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>

@endsection