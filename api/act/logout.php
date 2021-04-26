<?php
    $User->logout();
    $json['status'] = 'success';
    $json['msg'] = '您已成功登出';
    $Session->set("success","您已成功登出");

?>