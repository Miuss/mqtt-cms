<?php
    
    if($User->islogin){
        $time=$_GET["t"]/1000;
        $Device = new Device();
        $json["device"]["num"] = $Device->getDeviceNum();
        $json["device"]["online"] = $Device->getDeviceOnline($time);
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
    

