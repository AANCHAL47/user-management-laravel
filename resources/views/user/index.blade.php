@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-4 rounded-top">
            <h5 class="mb-0">User Profile</h5>
            <a href="{{ route('user.edit',['id', Auth::user()->id]) }}" class="btn btn-warning btn-sm">Edit Profile</a>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- User Details -->
                    <div class="mb-4">
                        <h4 class="mb-3">Personal Information</h4>
                        <p class="mb-1"><strong>Name:</strong> <span class="text-muted">{{ Auth::user()->name }}</span></p>
                        <p class="mb-1"><strong>Email:</strong> <span class="text-muted">{{ Auth::user()->email }}</span></p>

                        <!-- Additional Details from user_details table -->
                        <p class="mb-1"><strong>Phone:</strong> <span class="text-muted">{{ Auth::user()->details->phone ?? 'Not provided' }}</span></p>
                        <p class="mb-1"><strong>Address:</strong> <span class="text-muted">{{ Auth::user()->details->address ?? 'Not provided' }}</span></p>
                        <p class="mb-1"><strong>City:</strong> <span class="text-muted">{{ Auth::user()->details->city ?? 'Not provided' }}</span></p>
                        <p class="mb-1"><strong>Pincode:</strong> <span class="text-muted">{{ Auth::user()->details->pincode ?? 'Not provided' }}</span></p>
                        <p class="mb-1"><strong>Country:</strong> <span class="text-muted">{{ Auth::user()->details->country ?? 'Not provided' }}</span></p>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3">Account Information</h5>
                        <p class="mb-1"><strong>Member Since:</strong> <span class="text-muted">{{ Auth::user()->created_at->format('M d, Y') }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
