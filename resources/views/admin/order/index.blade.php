@extends('layouts.templates.index')

@section('sub-content')
    <div class="bg-white p-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Order item</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Orderer Id</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->item }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>
                            @if ($order->status == 'Packing')
                                <p class="text-info">Packing</p>
                            @elseif($order->status == 'Shipping')
                                <p class="text-primary">Shipping</p>
                            @elseif ($order->status == 'Delivered')
                                <p class="text-success">Delivered</p>
                            @else
                                <p class="text-danger">Canceled</p>
                            @endif
                        </td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->price }}</td>
                        <td class="row">
                            <div class="col-6">
                                <a href="{{ route('order.show', $order) }}">
                                    <i class="fas fa-eye text-muted"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('order.destroy', $order) }}" method="post" onclick="return confirm('Are you sure?')">
                                    @csrf
                                    <button class="btn btn-sm btn-clean">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection