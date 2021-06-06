@extends('layouts.templates.index')

@section('sub-content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white p-5">
        @if (count($data) > 0)
            @foreach ($data as $order)
                <div class="row border my-3 py-2">
                    <div class="col-2">
                        <a href="{{ route('order.show', $order) }}">
                            @if ($order->getItem->getFirstMediaUrl('item_images'))
                                <img src="{{ $order->getItem->getFirstMediaUrl('item_images') }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            @endif
                        </a>
                    </div>
                    <div class="col-8">
                        <h4>{{ $order->item }}</h4>
                        <p>Quantity: <b>{{ $order->quantity }}</b></p>
                        @if ($order->status == 'Packing')
                            <p class="text-info">Packing</p>
                        @elseif($order->status == 'Shipping')
                            <p class="text-primary">Shipping</p>
                        @elseif ($order->status == 'Delivered')
                            <p class="text-success">Delivered</p>
                        @else
                            <p class="text-danger">Canceled</p>
                        @endif
                        @if ($order->status == 'Packing')
                            <form action="{{ route('order.update', $order) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Canceled">
                                <input type="submit" value="Cancel Order" class="btn btn-danger">
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <h4 class="text-center">No Order placed yet</h4>
        @endif
    </div>
@endsection