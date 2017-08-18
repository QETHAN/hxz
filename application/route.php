<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
        'id' => '\d+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    '/' => 'index/index',
    '/user/:id' => 'index/showUser',

    'admin666/user/:id/edit' => 'admin/index/editUser',
    'admin666/user/:id/update' => ['admin/index/updateUser', ['method' => 'post']],

    'admin666' => 'admin/index/index',

    'admin666/user/add' => 'admin/index/addUser',
    'admin666/user/create' => ['admin/index/createUser', ['method' => 'post']],
];
