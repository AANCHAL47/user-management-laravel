@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-2">
            <h5 class="mb-0">Add {{ ucfirst(@$role) }}</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="{{ @$role }}">
            
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name<small class="text-danger">*</small></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label>Email<small class="text-danger">*</small></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label>Password<small class="text-danger">*</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        @error('password')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" class="form-control" required>
                        @error('password_confirmation')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
            
                @if($role === 'user')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Address</label>
                            <textarea name="address" rows="1" class="form-control" placeholder="Enter Address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
            
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone No." value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter City" value="{{ old('city') }}">
                            @error('city')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
            
                        <div class="col-md-4">
                            <label>Pincode<small class="text-danger">*</small></label>
                            <input type="number" name="pincode" class="form-control" placeholder="Enter Pincode" value="{{ old('pincode') }}" required>
                            @error('pincode')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
            
                        <div class="col-md-4">
                            <label>Country<small class="text-danger">*</small></label>
                            <select name="country" class="form-control" required>
                                <option value="">-- Select Country --</option>
                                <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                            </select>
                            @error('country')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                @endif
            
                <hr>
                <button type="submit" class="btn btn-primary">Create {{ ucfirst(@$role) }}</button>
            </form>            
                      
        </div>
    </div>
</div>

@endsection