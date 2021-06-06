@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->hasAnyRole(['superadmin', 'admin']))
                        Welcome, Admin
                    @else
                        Welcome, {{ auth()->user()->name }}
                    @endif
                </div>

                <div class="card-body">
                   <div class="row p-3">
                       <div class="col-4">
                           @if ($profile->getFirstMediaUrl('profile_images'))
                               <img src="{{ $profile->getFirstMediaUrl('profile_images') }}" alt="profile image" style="width: 100px; height:100px; object-fit:cover;">
                           @endif
                       </div>
                       <div class="col-8">
                           <h3>Your Shipping Address</h3>
                           <p><b>Addresss: </b>{{ $profile->address??'-' }}</p>
                           <p><b>Phone number: </b>{{ $profile->phone_number??'-' }}</p>
                           <p>
                               <a href="{{ route('profile.edit', $profile) }}" class="btn btn-info">Update Profile</a>
                           </p>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
