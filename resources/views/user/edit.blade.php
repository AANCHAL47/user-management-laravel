@extends('layouts.app')

@section('title', 'User')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Edit Profile</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update') }}">
                @csrf

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
                
                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->details->phone ?? '') }}">
                        @if ($errors->has('phone'))
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->details->address ?? '') }}">
                        @if ($errors->has('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $user->details->city ?? '') }}">
                        @if ($errors->has('city'))
                            <small class="text-danger">{{ $errors->first('city') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Pincode</label>
                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $user->details->pincode ?? '') }}">
                        @if ($errors->has('pincode'))
                            <small class="text-danger">{{ $errors->first('pincode') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label>Country<small class="text-danger">*</small></label>
                        <select name="country" class="form-control" required>
                            <option value="">-- Select Country --</option>
                            <option value="India" {{ old('country', $user->details->country ?? '') == 'India' ? 'selected' : '' }}>India</option>
                            <option value="United States" {{ old('country', $user->details->country ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                            <option value="United Kingdom" {{ old('country', $user->details->country ?? '') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="Canada" {{ old('country', $user->details->country ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                            <option value="Australia" {{ old('country', $user->details->country ?? '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                        </select>
                        @if ($errors->has('country'))
                            <small class="text-danger">{{ $errors->first('country') }}</small>
                        @endif
                    </div>
                </div>                                
                <hr>
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('user.edit',['id', $user->id]) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection