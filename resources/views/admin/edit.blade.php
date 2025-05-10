@extends('layouts.app')
@section('title', 'Admin')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-2">
            <h5 class="mb-0">Edit {{ ucfirst($user->role) }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.update') }}" method="POST">
                @csrf
                
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="role" value="{{ $user->role }}">
    
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name<small class="text-danger">*</small></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Email<small class="text-danger">*</small></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave empty to keep the current password">
                        @if ($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Leave empty to keep the current password">
                        @if ($errors->has('password_confirmation'))
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @endif
                    </div>
                </div>
                
                @if($user->role === 'user')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{ old('address', $user->details->address) }}</textarea>
                            @if ($errors->has('address'))
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            @endif
                        </div>
                
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->details->phone) }}">
                            @if ($errors->has('phone'))
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            @endif
                        </div>
                    </div>
                
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $user->details->city) }}">
                            @if ($errors->has('city'))
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                            @endif
                        </div>
                
                        <div class="col-md-4">
                            <label>Pincode</label>
                            <input type="number" name="pincode" class="form-control" value="{{ old('pincode', $user->details->pincode) }}">
                            @if ($errors->has('pincode'))
                                <small class="text-danger">{{ $errors->first('pincode') }}</small>
                            @endif
                        </div>
                
                        <div class="col-md-4">
                            <label>Country</label>
                            <select name="country" class="form-control" required>
                                <option value="">-- Select Country --</option>
                                <option value="India" {{ old('country', $userDetails->country ?? '') == 'India' ? 'selected' : '' }}>India</option>
                                <option value="United States" {{ old('country', $userDetails->country ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="United Kingdom" {{ old('country', $userDetails->country ?? '') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="Canada" {{ old('country', $userDetails->country ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Australia" {{ old('country', $userDetails->country ?? '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                            </select>
                            @if ($errors->has('country'))
                                <small class="text-danger">{{ $errors->first('country') }}</small>
                            @endif
                        </div>
                    </div>
                @endif                
    
                <hr>
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-secondary">Cancel</a>
            </form>                      
        </div>
    </div>
</div>

@endsection
