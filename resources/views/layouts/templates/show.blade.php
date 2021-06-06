@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white p-3">
            @yield('sub-content')
            <br>
            <div class="clearfix">
                <a href="javascript:window.history.back()" class="btn btn-danger float-right">Back</a>
            </div>
        </div>
    </div>
@endsection