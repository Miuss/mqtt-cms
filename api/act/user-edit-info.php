<?php
    $des = filter_var($_POST["des"], FILTER_SANITIZE_STRING);
    $sex = filter_var($_POST["sex"], FILTER_SANITIZE_STRING);

    if($User->islogin){
        if($User->editUserInfo($des,$sex)){
            $json['status'] = "success";
            $json['msg'] = "用户信息修改成功";
        }else{
            $json['status'] = "error";
            $json['msg'] = "用户信息修改失败";
        }
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
?>