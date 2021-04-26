<?php

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    if(!$User->islogin){
        if(empty($username)&&empty($password)){
            $json['status'] = "error";
            $json['msg'] = "请填写您账号和密码";
        }else{
            $e = $User->login($username,$password);
            if($e == 2){
                $json['status'] = "success";
                $json['msg'] = "登录成功";
                $Session->set("success","您已登录成功");
            }else{
                $json['status'] = "error";
                $json['msg'] = "账号或密码错误";
            }
        }
    }else{
        $json['status'] = "success";
        $json['msg'] = "您已经登录过了，正在为您跳转到首页";
    }

?>