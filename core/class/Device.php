<?php

class Device {

    public function getDeviceNum() {
        global $DB;

        $result = $DB->query("SELECT count(*) AS `num` FROM `mqtt_user` WHERE `is_superuser` != 1");
        $info = $result->fetch_object();

        return $info->num;

    }

    public function getDeviceOnline($time) {
        global $DB;

        $endtime = $time-5;
        $result = $DB->query("SELECT count(*) AS `online`,`updatetime` FROM `mqtt_msg` WHERE `updatetime` <= '{$time}' AND `updatetime` >= '{$endtime}' GROUP BY `updatetime` ORDER BY `updatetime` DESC LIMIT 1");
        $info = $result->fetch_object();

        return $info->online;

    }

}