<?php
/**
 * qcimg - geetest.php
 * Copyright (c) 2015 - 2018.,QCTech ,All rights reserved.
 * Created by: QCTech
 * Created Time: 2018-12-09 - 15:55
 */
/**
 * 使用Get的方式返回：challenge和capthca_id 此方式以实现前后端完全分离的开发模式 专门实现failback
 * @author Tanxu
 */
//error_reporting(0);
require (LibraryPath.'Geetestlib.class.php');

$NewConfig = $_POST;
foreach ($NewConfig as $Key => $Value) {
    if (!array_key_exists($Key, $Config) || $Value == $Config[$Key]) {
        unset($NewConfig[$Key]);
    } else {
        $Config[$Key] = $NewConfig[$Key];
    }
}
$GtSdk = new GeetestLib($Config['GeetestID'], $Config['GeetestKey']);
session_start();
$data = array(
    "user_id" => GetCookie('UserID'), # 网站用户id
    "client_type" => GetCookie('View'), #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
    "ip_address" => CurIP() # 请在此处传输用户请求验证时所携带的IP
);

$status = $GtSdk->pre_process($data, 1);
$_SESSION['gtserver'] = $status;
$_SESSION['user_id'] = $data['user_id'];
echo $GtSdk->get_response_str();