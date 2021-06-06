@extends('layouts.templates.index')

@section('sub-content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (auth()->user()->hasAnyRole(['superadmin', 'admin']))
        <div class="py-2 text-right">
            <a href="{{ route('item.create') }}" class="btn btn-outline-info"><i>+</i> Add Item</a>
        </div>
    @endif
    @if (count($items) > 0)
        <div class="flex">
            @foreach ($items as $item)
                <div class="d-inline-block bg-white p-3 mx-3 my-2">
                    <a href="{{ route('item.show', $item) }}">
                        <img src="{{ $item->getFirstMediaUrl('item_images')?$item->getFirstMediaUrl('item_images'):asset('images/item_placeholder_image.jpg') }}" alt="item image" style="width: 200px; height:200px; object-fit:cover;">
                    </a>
                    <div>
                        <h4>{{ $item->name }}</h4>
                        @if ($item->in_stock)
                            <p>In stock: {{ $item->available_amount }}</p>    
                        @else
                            <p class="text-danger">Out of stock</p>
                        @endif
                        <p>Rs: {{ $item->price_per }} per piece</p>
                        @if (auth()->user()->hasAnyRole(['superadmin', 'admin']))
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('item.edit', $item) }}"><i class="fas fa-edit text-muted"></i></a>
                                </div>
                                <div class="col-6">
                                    <form class="d-inline" action="{{ route('item.destroy', $item) }}" method="post"
                                    onclick="return confirm('Are you sure?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-clean btn-icon btn-hover-danger">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3 class="text-center">No items avaliable</h3>
    @endif
@endsection