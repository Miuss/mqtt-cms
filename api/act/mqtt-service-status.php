<?php
    if($User->islogin){
        $MQTT = new MQTT();
        $data = $MQTT->getMQTTServiceStatus();
        if($data == null){
            $json["status"] = "error";
            $json["msg"] = "获取MQTT监控程序状态失败，请检查平台是否正确部署";
        } else {
            $json["status"] = "success";
            if($data->status){
                $json["python-status"] = "online";
            }else{
                $json["python-status"] = "offine";
            }
            if($data->publish){
                $json["python-publish"] = "online";
            }else{
                $json["python-publish"] = "offine";
            }
        }
    }else {
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }
?>