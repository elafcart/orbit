<?php

return [
    [
        'name' => 'Elafcart',
        'flag' => 'plugins.elafcart',
    ],
    [
        'name' => 'Elafcart Items',
        'flag' => 'elafcart.index',
        'parent_flag' => 'plugins.elafcart',
    ],
    [
        'name' => 'Create',
        'flag' => 'elafcart.create',
        'parent_flag' => 'elafcart.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'elafcart.edit',
        'parent_flag' => 'elafcart.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'elafcart.destroy',
        'parent_flag' => 'elafcart.index',
    ],
];
