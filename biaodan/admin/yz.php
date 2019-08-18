<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/18 0018
 * Time: 16:36
 */
$config = require_once 'config.php';
session_start();
$bs = isset($_SESSION['bs']) ? $_SESSION['bs'] : 0;
if(!$bs){
    exit(
        json_encode([
            'Status' => 300,
            'url' =>  $config['ym'] . 'admin/login.html'
        ])
    );
}