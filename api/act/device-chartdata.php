<?php
    
    if($User->islogin){
        $deviceid = $_GET["device"];
        $charttype = $_GET["chart"];
        if($deviceid==""||$charttype=="") {
            $json['status'] = "error";
            $json['msg'] = "参数错误";
        }else{
            $Device = new Device();
            $json['status'] = "success";
            if($charttype=="T")
                $json["data"] = $Device->getDeviceTCharts($deviceid)->chartdata;
        }
    }else{
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }