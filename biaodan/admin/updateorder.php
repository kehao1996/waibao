<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/18 0018
 * Time: 13:46
 */
include_once __DIR__ . '/../PdoQuery.class.php';

$result['code'] = 200;
$result['msg'] = 'ok';
$result['data'] = [];
$pdo = new PdoQuery();

$status = isset($_POST['status']) ? $_POST['status'] : '';
if(empty($status)){
    exit(json_encode([
        'status' => 201,
        'Msg' => '修改失败'
    ]));
}

$status = explode(',',$status);
$pdo->update('order',[
    'status' => $status[1]
],[
    'id' => $status[0]
]);

exit(json_encode([
    'status' => 200,
    'Msg' => 'ok'
]));
