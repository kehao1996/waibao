<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/18 0018
 * Time: 16:31
 */


if($_POST['username'] == 'waibao' && $_POST['password'] == 'waibao112233...'){
    session_start();
    $_SESSION['bs'] = 1;
    exit(json_encode([
        'Status' => 200,
        'Msg' => '登陆成功'
    ]));
}

exit(json_encode([
    'Status' => 201,
    'Msg' => '账号或者密码错误'
]));