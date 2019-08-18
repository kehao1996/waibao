<?php
require_once './PdoQuery.class.php';
$sj = $_POST['sj'];
if(!empty($sj)){

    $type = isset( $_POST['type']) ? $_POST['type'] : 0;
    $pdo = new PdoQuery();
    switch($type){
        case 1:
            $data['content'] = $_POST['content'];
            $data['update'] = $_POST['update'];
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $data['createtime'] = date('Y-m-d H:i:s');
            $data['status'] = 0;

            if(strlen($data['content']) < 5){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '故障内容不可少于5个字'
                ]));
            }

            if(empty($data['name'])){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '姓名不可以为空'
                ]));
            }

            if(empty($data['address']) || $data['address'] == '湖南省长沙市'){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '请填写具体地址'
                ]));
            }

            if(!isMobile($data['phone'])){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '请输入正确的手机号码'
                ]));
            }
            $_id = $pdo->clear()->select('id')->from('order')->where([
                'phone' => $data['phone'],
                'status' => 0
            ])->getValue();

            if($_id){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '当前订单处于审核中'
                ]));
            }

            $status = $pdo->insert('order',$data);
            exit(json_encode([
                'Status' => 200,
                'Msg' => '填写成功'
            ]));
            break;
        case 2 :
            $data['content'] = $_POST['content'];
            $data['createtime'] = date('Y-m-d H:i:s');

            if(strlen($data['content']) < 10){
                exit(json_encode([
                    'Status' => 201,
                    'Msg' => '投诉或建议不可少于10个字'
                ]));
            }

            $status = $pdo->clear()->insert('jy',$data);
            exit(json_encode([
                'Status' => 200,
                'Msg' => '填写成功谢谢您的建议'
            ]));
            break;
        default:
            exit(json_encode([
                'Status' => 200,
                'Msg' => 'error'
            ]));
            break;
    }

}

function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^1[3,4,5,7,8,9]{1}[\d]{9}$#', $mobile) ? true : false;
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/18 0018
 * Time: 11:00
 */
