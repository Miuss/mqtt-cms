<?php
    
    if($User->islogin){
        $deviceid = $_GET["device"];
        if($deviceid=="") {
            $json['status'] = "error";
            $json['msg'] = "参数错误";
        }else{
            $Device = new Device();
            $json['status'] = "success";
            $json["data"] = $Device->getDeviceData($deviceid);
        }
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }