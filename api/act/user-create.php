<?php
    if($User->islogin){
        $username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email=$_POST['email'];
        $password=$_POST['password'];
        $mailpattern = "/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/";
        if($username==""){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '请输入您的用户名';
        }else if(strlen($username)>20){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '用户名长度不能超过20个字符';
        }else if($email==""){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '请输入您的邮箱';
        }else if(!preg_match($mailpattern,$email)){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '邮箱格式错误，请重新输入正确的邮箱';
        }else if(!$password){
            $json['status'] = 'error';
            $json['code'] = 1;
            $json['msg'] = '请输入您的密码';
        }else {
            $result = $DB->query("SELECT * FROM `users` WHERE `username`='{$username}'");
            $info=$result->fetch_object();
            if ($info>0){
                $json['status'] = 'error';
                $json['code'] = -1;
                $json['msg'] = '该用户名已注册，请换其他的试试';
            }else{
                $result = $DB->query("SELECT * FROM `users` WHERE `email`='{$email}'");
                $info=$result->fetch_object();
                if ($info>0){
                    $json['status'] = 'error';
                    $json['code'] = -1;
                    $json['msg'] = '该邮箱账户已注册';
                }else{
                    $e = $User->register($username,$password,$email);
                    if($e){
                        $json['status'] = 'success';
                        $json['msg'] = '创建用户'.$username.'成功';
                        $Session->set("success","创建用户".$username."成功");
                    }else{
                        $json['status'] = 'error';
                        $json['code'] = -1;
                        $json['msg'] = '注册失败请联系网站管理员';
                    }
                }
            }
        }
    }else {
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
?>