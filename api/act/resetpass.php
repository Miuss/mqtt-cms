<?php
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];
    $code = $_POST["code"];

    if(!$User->islogin){
        if($password==""){
            $json['status'] = "error";
            $json['code'] = 0;
            $json['msg'] = "密码不能为空";
        }else if($repassword==""){
            $json['status'] = "error";
            $json['code'] = 1;
            $json['msg'] = "重复密码不能为空";
        }else if($password!=$repassword){
            $json['status'] = "error";
            $json['code'] = 1;
            $json['msg'] = "两次密码输入不一致";
        }else if($email==""){
            $json['status'] = "error";
            $json['code'] = -1;
            $json['msg'] = "邮件不能为空";
        }else if($code==""){
            $json['status'] = "error";
            $json['code'] = -1;
            $json['msg'] = "验证码不能为空";
        }else if($email!=$Session->get("code_email")){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '非法伪造邮箱，请重试';
        }else if(md5($code)!=$Session->get("code")){
            $json['status'] = "error";
            $json['code'] = -1;
            $json['msg'] = "邮箱验证码错误";
        }else{
            $uid = $User->email_get_uid($email);
            $e = $User->resetpassword($uid,$password);
            if($e == 1){
                $json['status'] = "success";
                $json['msg'] = "密码重置成功";
                $Session->set("success","密码重置成功");
            }else{
                $json['status'] = "error";
                $json['msg'] = "系统内部错误";
            }
        }
    }else{
        $json['status'] = "success";
        $json['msg'] = "您已经登录过了，正在为您跳转到首页";
    }
?>