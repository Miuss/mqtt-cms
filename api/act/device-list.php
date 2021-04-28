<?php
    
    if($User->islogin){
        $Device = new Device();
        $json['status'] = "success";
        $json["data"] = $Device->getDeviceList();;
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }