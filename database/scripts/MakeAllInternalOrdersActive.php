<?php

namespace Database\Scripts;

use App\Models\InternalOrder;

class MakeAllInternalOrdersActive
{
    public static function handle()
    {
        $orders = InternalOrder::all();

        foreach ($orders as $order) {
            if(isset($order->data['status'])) {
                continue;
            }

            $data = $order->data;
            $data["status"] = 'active';
            $order->data = $data;
            $order->save();
        }
    }
}
