<?php
    $time=$_GET["t"]/1000;
    
    $Device = new Device();
    $json["device"]["num"] = $Device->getDeviceNum();
    $json["device"]["online"] = $Device->getDeviceOnline($time);
    

