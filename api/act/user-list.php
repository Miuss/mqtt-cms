<?php
    if($User->islogin){
        $json['status'] = "success";
        $json['data'] = $User->get_user_list();
    }else {
        $json['status'] = "error";
        $json['msg'] = "您尚未登录，请重新登录！";
    }