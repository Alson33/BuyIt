<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Notifications\OrderNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $or = Order::findOrFail($order->id);

        $item = Item::findOrFail($or->item_id);
        $item->available_amount = $item->available_amount - $or->quantity;
        $item->update();
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $or = Order::findOrFail($order->id);

        if($or->status == 'Canceled')
        {
            $user = User::findOrFail($or->user_id);
            $data['name'] = $or->item;
            $data['quantity'] = $or->quantity;

            $user->notify(new OrderNotification($data));

            $item = Item::findOrFail($or->item_id);
            $item->available_amount = $item->available_amount + $or->quantity;
            $item->update();
        }
            
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
