@extends('layouts.templates.show')

@section('sub-content')
    <div class="row p-3">
        <div class="col-6">
            <p><b>Item: </b>{{ $order->item }}</p>
            <p><b>Quantity: </b>{{ $order->quantity }}</p>
            <p><b>Price per: </b>{{ $order->getItem->price_per }}</p>
            <p><b>Total price: </b>{{ $order->price }}</p>
            <p>
                <b>Status: </b>
                @if ($order->status == 'Packing')
                    <span class="text-info">Packing</span>
                @elseif($order->status == 'Shipping')
                    <span class="text-primary">Shipping</span>
                @elseif ($order->status == 'Delivered')
                    <span class="text-success">Delivered</span>
                @else
                    <span class="text-danger">Canceled</span>
                @endif
                <br><br>
                @if (auth()->user()->hasAnyRole(['superadmin', 'admin']))
                    <form action="{{ route('order.update', $order) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-6">
                                <select name="status" class="form-control">
                                    <option value="Packing"
                                        @if ($order->status == 'Packing')
                                            selected
                                        @endif
                                    >Packing</option>
                                    <option value="Shipping"
                                        @if ($order->status == 'Shipping')
                                            selected
                                        @endif
                                    >Shipping</option>
                                    <option value="Delivered"
                                        @if ($order->status == 'Delivered')
                                            selected
                                        @endif
                                    >Delivered</option>
                                    <option value="Canceled"
                                        @if ($order->status == 'Canceled')
                                            selected
                                        @endif
                                    >Canceled</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="submit" class="btn btn-info" value="Edit Status">
                            </div>
                        </div>
                    </form>
                @else    
                    @if ($order->status == 'Packing')
                        <form action="{{ route('order.update', $order) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="Canceled">
                            <input type="submit" value="Cancel Order" class="btn btn-danger">
                        </form>
                    @endif
                @endif
            </p>
        </div>
        <div class="col-2"></div>
        <div class="col-4">
            @if ($order->getItem->getFirstMediaUrl('item_images'))
                <img src="{{ $order->getItem->getFirstMediaUrl('item_images') }}" alt="" style="width: 150px; height: 150px; object-fit:cover;">
            @endif
        </div>
    </div>
@endsection