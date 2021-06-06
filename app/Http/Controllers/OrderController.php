<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $info['data'] = $order;

        return view('order.index', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'required',
        ]);

        $data = $request->all();

        // dd($data);

        $data['user_id'] = auth()->user()->id;

        $item = Item::findOrFail($request->item_id);
        $data['price'] = $data['quantity']*$item->price_per;
        $data['item'] = $item->name;

        $order = new Order($data);
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order placed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = Order::findOrFail($order->id);
        $info['order'] = $orders;

        return view('order.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $data = $request->all();

        $updateOrder = Order::findOrFail($order->id);
        $updateOrder->update($data);

        if(auth()->user()->hasAnyRole(['superadmin', 'admin']))
            return redirect()->route('order.adminIndex')->with('success', 'Updated successfully');
        
        return redirect()->route('order.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $orders = Order::findOrFail($order->id);

        $orders->delete();

        return redirect()->route('order.adminIndex');
    }

    public function adminIndex()
    {
        $orders = Order::orderBy('id', 'desc')->get();

        $info['orders'] = $orders;

        return view('admin.order.index', $info);
    }
}
