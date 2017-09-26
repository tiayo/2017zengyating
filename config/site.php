<?php

return [
    'administrator' => env('SITE_ADMINISTRATE'),
    'upload_image_size' => 1024,
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
    ],
    'week' => [
        1 => '周一',
        2 => '周二',
        3 => '周三',
        4 => '周四',
        5 => '周吴五',
        6 => '周六',
        0 => '周日',
    ],
];