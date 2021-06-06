@extends('layouts.templates.form')
@section('card-title')
    <h3>Edit Item</h3>
@endsection
@section('sub-content')
    <form action="{{ route('item.update', $item) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('item.form')
        <div class="form-group">
            <input type="submit" value="Update Item" class="btn btn-info float-right">
        </div>
    </form>
@endsection