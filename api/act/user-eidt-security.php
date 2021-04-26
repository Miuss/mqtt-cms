<?php
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $renewpassword = $_POST["renewpassword"];
    $email = $_POST["email"];

    if($User->islogin){
        if($oldpassword!=""){
            if ($User->uinfo->password!=md5($oldpassword.$User->uinfo->salt)){
                $json['status'] = 'error';
                $json['msg'] = '密码错误';
            }else{
                $pattern = "/^.*(?=.{8,32})(?=.*\d)(?=.*[A-Za-z]{1,}).*$/";
                if(!preg_match($pattern,$newpassword)){
                    $json['status'] = 'error';
                    $json['msg'] = '密码强度较弱，请设置为长度位8位以上并包含字母和数字的密码';
                }else if($newpassword==$renewpassword){
                    $e = $User->resetpassword($User->user_id,$newpassword);
                    if($e == 1){
                        $json['status'] = "success";
                        $json['msg'] = "密码修改成功";
                    }else{
                        $json['status'] = "error";
                        $json['msg'] = "系统错误";
                    }
                }else{
                    $json['status'] = "error";
                    $json['msg'] = "两次新密码输入有误";
                }
            }
        }else{
            $json['status'] = "error";
            $json['msg'] = "请填写您的旧密码！";
        }
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
?>