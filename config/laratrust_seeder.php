<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d,s',
            'admins' => 'c,r,u,d,s,b,f,re,rt',
            'vendors' => 'c,r,u,d,s,b,f,re,rt',
            'coupons' => 'c,r,u,d,s,f',
        ],
        'vendor' => [
            'coupons' => 'c,r,u,d,s,f',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'show',
        'b' => 'block',
        'rt' => 'readTrashed',
        're' => 'restore',
        'f' => 'forceDelete',
    ]
];
