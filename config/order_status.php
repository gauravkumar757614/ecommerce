<?php

return [
    // admin status system
    'order_status_admin' => [
        'pending'   =>  [
            'status'    => 'Pending',
            'details'   => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status'    => 'Processed and ready to ship',
            'details'   => 'Your package has been processed and will be with our delivery partner soon'
        ],
        'dropped_off' => [
            'status'    => 'Dropped Off',
            'details'   => 'Your package has been dropped off by the seller'
        ],
        'shipped' => [
            'status'    => 'Shipped',
            'details'   => 'Your packages has arrived at our logistics facility'
        ],
        'out_for_delivery' =>   [
            'status'    =>  'Out for delivery',
            'details'   =>  'Package is out for delivery our partner will deliverd it soon'
        ],
        'delivered' =>  [
            'status'    =>  'Delivered',
            'details'   =>  'Package was handed to resident'
        ],
        'canceled' =>  [
            'status'    =>  'Canceled',
            'details'   =>  'Canceled'
        ]
    ],
    // vendor status system
    'order_status_vendor' => [
        'pending'   =>  [
            'status'    => 'Pending',
            'details'   => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status'    => 'Processed and ready to ship',
            'details'   => 'Your package has been processed and will be with our delivery partner soon'
        ],
    ]
];
