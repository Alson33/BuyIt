@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card--mobile">
            <div class="card-header">
                @yield('card-title')
            </div>
            <div class="card-body">
                @yield('sub-content')
            </div>
        </div>
    </div>
@endsection