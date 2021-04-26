<?php

/* 数据库配置 */
$DatabaseServer = "103.45.128.31"; //"115.231.175.7"
$DatabaseUser   = "cms";
$DatabasePass   = "Miu@051900";
$DatabaseName   = "cms";

/* 数据库连接 */
$DB = new mysqli($DatabaseServer, $DatabaseUser, $DatabasePass, $DatabaseName);
$DB->query("SET NAMES 'utf8mb4'");

?>
