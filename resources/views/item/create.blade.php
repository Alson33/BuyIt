@extends('layouts.templates.form')
@section('card-title')
    <h3>Add New Item</h3>
@endsection
@section('sub-content')
    <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('item.form')
        <div class="form-group">
            <input type="submit" value="Add Item" class="btn btn-info float-right">
        </div>
    </form>
@endsection