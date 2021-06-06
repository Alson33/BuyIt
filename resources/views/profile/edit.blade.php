@extends('layouts.templates.form')
@section('card-title')
    <h3>Update Profile</h3>
@endsection
@section('sub-content')
    <div class="p-3">
        <form action="{{ route('profile.update', $profile) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-6">
                    <label for="">Address *</label>
                    <input type="text" required name="address" value="{{ old('address', $profile->address??'-') }}" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Phone Number *</label>
                    <input type="number" required name="phone_number" value="{{ old('address', $profile->phone_number??'-') }}" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Profile Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </div>
@endsection