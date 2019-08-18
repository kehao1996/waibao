<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/18 0018
 * Time: 13:46
 */
include_once __DIR__ . '/../PdoQuery.class.php';

$result['code'] = 0;
$result['msg'] = 'ok';
$result['data'] = [];
$pdo = new PdoQuery();

$pageindex = isset($_GET['page']) ? $_GET['page'] : 1;
$pagesize = isset($_GET['limit']) ? $_GET['limit'] : 12;
$status = isset($_GET['status']) ? $_GET['status'] : 0;

$where = [];
if(!empty($status)){
    $where['status'] = $status - 1;
}

$total = $pdo->clear()->select('count(*)')->from('order')->where($where)->getValue();
$result_data = $pdo->clear()->select('*')->from('order')->where($where)->limit(($pageindex - 1) * $pagesize,$pagesize)->order('status asc,id desc')->getAll();
foreach($result_data as $k=>$v){
    $result_data[$k]['imgurl'] = explode(';',$v['update']);
    $result_data[$k]['url'] = 'http://test.waibao.com/';
}

$result['data'] = $result_data;
$result['count'] = $total;
exit(json_encode($result));