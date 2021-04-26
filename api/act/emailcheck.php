<?php 
    $email=$_POST["email"];
    $code=$_POST["code"];

    if($email=="") {
        $json['status'] = 'error';
        $json['code'] = 0;
        $json['msg'] = '邮箱不能为空';
    }else if($code=="") {
        $json['status'] = 'error';
        $json['code'] = 1;
        $json['msg'] = '验证码不能为空';
    }else if($email!=$Session->get("code_email")||md5($code)!=$Session->get("code")) {
        $json['status'] = 'error';
        $json['code'] = 1;
        $json['msg'] = '邮箱验证码错误';
    }else {
        $json['status'] = 'success';
        $json['msg'] = '邮箱验证码验证成功';
    }

?>