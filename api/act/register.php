<?php
    if (isset($_SESSION['islogin'])) {
        $json['status'] = 'success';
        $json['msg'] = '您已经登录，请勿重复登录！';
    }else{
        $username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email=$_POST['email'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        $email_code=$_POST['code'];
        $pattern = "/^.*(?=.{8,32})(?=.*\d)(?=.*[A-Za-z]{1,}).*$/";
        $mailpattern = "/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/";
        $namepattern = "/[A-Za-z0-9_\-\u4e00-\u9fa5]+/";
        if($username==""){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '请输入您的用户名';
        }else if(!preg_match($namepattern,$username)){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '用户名有非法字符，请使用中英文数字结合';
        }else if(strlen($username)>20){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '用户名长度不能超过20个字符';
        }else if($email==""){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '请输入您的邮箱';
        }else if($email!=$Session->get("code_email")){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '非法伪造邮箱，请重试！';
        }else if(!preg_match($mailpattern,$email)){
            $json['status'] = 'error';
            $json['code'] = -1;
            $json['msg'] = '邮箱格式错误，请重新输入正确的邮箱';
        }else if(!$password){
            $json['status'] = 'error';
            $json['code'] = 1;
            $json['msg'] = '请输入您的密码';
        }else if($password!=$repassword){
            $json['status'] = 'error';
            $json['code'] = 1;
            $json['msg'] = '两次密码输入不同，请重试！';
        }else if(!preg_match($pattern,$password)){
            $json['status'] = 'error';
            $json['code'] = 1;
            $json['msg'] = '密码强度较弱，请设置为长度位8位以上并包含字母和数字的密码';
        }else if(md5($email_code)!=$Session->get("code")){
            $json['status'] = 'error';
            $json['msg'] = '验证码输入错误';
        }else{
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
                    unset($_SESSION['code']);
                    unset($_SESSION['code_email']);
                    if($e){
                        $json['status'] = 'success';
                        $json['msg'] = '注册成功';
                        $Session->set("success","您已注册成功");
                    }else{
                        $json['status'] = 'error';
                        $json['code'] = -1;
                        $json['msg'] = '注册失败请联系网站管理员';
                    }
                }
            }
        }
    }
?>