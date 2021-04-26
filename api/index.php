<?php

include '../core/init.php';

header('Access-Control-Allow-Methods:GET');
header('Content-type: application/json');

//用户验证
if (isset($_COOKIE['email'])) {
    # 若记住了用户信息,则直接传给Session
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['islogin'] = 1;
}

if(isset($_GET['act'])) {
	$_GET['act'] = htmlspecialchars($_GET['act'], ENT_QUOTES);
	$act = glob('act/' . '*.php');
	$act = preg_replace('(act/|.php)', '', $act);

	if(in_array($_GET['act'], $act)) {
        include 'act/'.$_GET['act'].'.php';
        echo json_encode($json, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	} else {
		echo "非法访问";
	}
}else{
    echo "非法访问";
}

?>