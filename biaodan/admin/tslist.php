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
$pagesize =isset($_GET['limit']) ? $_GET['limit'] : 12;

$total = $pdo->clear()->select('count(*)')->from('jy')->where([])->getValue();
$result_data = $pdo->clear()->select('*')->from('jy')->where([])->limit(($pageindex - 1) * $pagesize,$pagesize)->order('id desc')->getAll();
$result['data'] = $result_data;
$result['count'] = $total;
exit(json_encode($result));