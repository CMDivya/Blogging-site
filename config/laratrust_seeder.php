<?php

return [
    'role_structure' => [
        'superadministrator' => [
            
            
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'categories'=>'c,r,u,d',
            'tags'=>'c,r,u,d',
            'blogs'=> 'c,r,u,d',
            'permissions'=>'r',
            'roles'=>'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'categories'=>'c,r,u,d',
            'tags'=>'c,r,u,d',
            'blogs'=> 'c,r,u,d',
            
        ],
        'author' => [
            'blogs' => 'c,r,u',
            'profile' => 'r,u'
        ],
        'test' => [
            'categories' => 'r',
            'blogs' => 'c,r,u',
            'profile' => 'r,u'
        ],
        'user' => [
            'blogs' => 'c,r,u',
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
