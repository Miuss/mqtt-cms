<?php
    
    if($User->islogin){
        $name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $password=$_POST['password'];
        $mailpattern = "/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/";
        if($name==""){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '请输入设备名称';
        }else if(strlen($name)>32){
            $json['status'] = 'error';
            $json['code'] = 0;
            $json['msg'] = '设备名称长度不能超过32个字符';
        }else if(!$password){
            $json['status'] = 'error';
            $json['code'] = 1;
            $json['msg'] = '请输入设备密码';
        }else {
            $result = $DB->query("SELECT * FROM `devices` WHERE `name`='{$name}'");
            $info=$result->fetch_object();
            if ($info>0){
                $json['status'] = 'error';
                $json['code'] = -1;
                $json['msg'] = '该设备名称已存在，请换其他的试试';
            }else{
                $Device = new Device();
                $e = $Device->createDevice($name,$User->user_id,$password);
                if($e){
                    $json['status'] = 'success';
                    $json['msg'] = $name.'设备创建成功';
                    $Session->set("success",$name."设备创建成功");
                }else{
                    $json['status'] = 'error';
                    $json['code'] = -1;
                    $json['msg'] = '设备创建失败请重试';
                }
            }
        }
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
?>