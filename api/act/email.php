<?php
    $type=$_POST["type"];
    $email=$_POST["email"];
    $pattern="/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/";
    if(preg_match($pattern,$email)){
        switch($type){
            case "regcode":
                $result = $DB->query("SELECT * FROM `users` WHERE `email`='{$email}'");
                $info=$result->fetch_object();
                if ($info>0){
                    $json['status'] = 'error';
                    $json['msg'] = '该邮箱已被注册！';
                }else{
                    $code=substr(md5(microtime(true)), 0, 6);
                    $Session->set("code_email",$email);
                    $Session->set("code",md5($code));
                    $o=Email::sendEmail($email,"欢迎您注册McStatus游戏社区账号","验证码：".$code);
                    if($o){
                        $json['status'] = 'success';
                        $json['msg'] = '验证码发送成功，请查看您的邮箱！';
                    }else{
                        $json['status'] = 'error';
                        $json['msg'] = '验证码发送失败！';
                    }
                }
                break;
            case "resetpass":
                $result = $DB->query("SELECT * FROM `users` WHERE `email`='{$email}'");
                $info=$result->fetch_object();
                if ($info>0){
                    $code=substr(md5(microtime(true)), 0, 6);
                    $Session->set("code_email",$email);
                    $Session->set("code",md5($code));
                    $o=Email::sendEmail($email,"密码重置邮件 | McStatus游戏社区","验证码：".$code);
                    if($o){
                        $json['status'] = 'success';
                        $json['msg'] = '已成功发送，请查看您的邮箱！';
                    }else{
                        $json['status'] = 'error';
                        $json['msg'] = '发送失败！';
                    }
                }else{
                    $json['status'] = 'error';
                    $json['msg'] = '该账户尚未注册！';
                }
                break;
        }
    }else{
        $json['status'] = 'error';
        $json['msg'] = '邮箱格式错误，请检查重试！';
    }
?>