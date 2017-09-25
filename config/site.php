<?php

return [
    'administrator' => env('SITE_ADMINISTRATE'),
    'list_num' => env('SITE_LIST_NUM'),
    'manager_group' => [ //理发师分组
        0 => '学徒',
        1 => '助理',
        2 => '总监',
        99 => '管理员'
    ],
    'title' => '美发管理系统', //网站标题
    'order_status' => [ //订单状态
        0 => '等待',
        1 => '接受',
        2 => '拒绝',
        3 => '超时',
        4 => '完成',
    ]
];