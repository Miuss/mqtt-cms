<?php

class Device {

    function makeDeviceId($length){
        
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, $length);
    }

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

        return $info->online?$info->online:0;

    }

    public function getDeviceList() {
        global $DB;

        $result = $DB->query("SELECT * FROM `devices` ORDER BY `createtime` DESC");
        $data = [];
        
        while($info = $result->fetch_object()) {
            $mqtt_result = $DB->query("SELECT * FROM `mqtt_msg` WHERE `client_id` = '{$info->id}' ORDER BY `updatetime` DESC LIMIT 1");
            if($mqtt = $mqtt_result->fetch_object()){
                $onlinetime = $mqtt->updatetime;
            }else{
                $onlinetime = "";
            }
            $data[] = array(
                "id" => $info->id,
                "name" => $info->name,
                "online" => $onlinetime!=""&&($onlinetime>=time()-5)?1:0,
                "createtime" => $info->createtime,
                "onlinetime" => $onlinetime,
                "lastdata" => json_decode($mqtt->msg)->params
            );
        }
        
        return $data;

    }

    public function getDeviceData($device) {
        global $DB;

        $result = $DB->query("SELECT * FROM `devices` WHERE `id` = '{$device}'");
        $info = $result->fetch_object();

        if($info > 0) {
            $msg_result = $DB->query("SELECT * FROM `mqtt_msg` WHERE `client_id` = '{$info->id}' ORDER BY `updatetime` DESC LIMIT 1");
            if($msg = $msg_result->fetch_object()){
                $onlinetime = $msg->updatetime;
                $data = json_decode($msg->msg)->params;
                $info->data = $data;
            }else{
                $onlinetime = "";
                $info->data = "";
            }
            $info->online = $onlinetime!=""&&($onlinetime>=time()-5)?1:0;
            $info->onlinetime = $onlinetime;
            $info->mqtt_username = $info->id."@U".$info->uid;
            $info->mqtt_topic_set = "sys/".$info->id."/set";
            $info->mqtt_topic_post = "sys/".$info->id."/post";
            return $info;
        }else{
            return null;
        }

    }

    public function getDeviceTCharts($device) {
        global $DB;

        $chart = new StdClass;
        $chart->data = [];
        $chart->chartdata = "[";

        $beginWeek=mktime(date('H'),date('i'),date('s'),date('m'),date('d')-5,date('Y'));
        $endWeek=mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'))-1;

        $result = $DB->query("SELECT * FROM `mqtt_msg` WHERE `client_id` = '{$device}' AND `updatetime` BETWEEN '{$beginWeek}' AND '{$endWeek}' ORDER BY `updatetime` ASC");
        while($data = $result->fetch_object()){
            $json = json_decode($data->msg)->params;
            $data->msg = $json;
            $chart->data[] = $data;
            $chart->chartdata .= "[".$data->updatetime."000,".$json->T."],";
        }

        $chart->chartdata = substr($chart->chartdata,0,strlen($chart->chartdata)-1);
        $chart->chartdata .= "]";

        if(count($chart->data) == 0) {
            $chart->exists = true;
            $chart->chartdata = "[]";
        } else {
            $chart->exists = false;
        }

        return $chart;
    }

    public function createDevice($name, $uid, $password) {
        global $DB;

        $id = $this->makeDeviceId(10);
        $createtime = time();
        //自动事务处理
		$DB->autocommit(FALSE);
		$error=false;

		$sql = "INSERT INTO `devices` (`id`,`name`,`createtime`,`uid`)VALUES(?,?,?,?)";
		$stmt = $DB->prepare($sql);
		$stmt->bind_param("ssss",$id, $name, $createtime, $uid);
		$stmt->execute();
		if(!$stmt->affected_rows) {
			$error=true;
		}
        $username = $id."@U".$uid;
		$sql = "INSERT INTO `mqtt_user` ( `username`, `password`, `salt`) VALUES(?, ?, NULL);";
		$stmt = $DB->prepare($sql);
		$stmt->bind_param("ss", $username, hash("sha256", $password));
		$stmt->execute();
		if(!$stmt->affected_rows) {
			$error=true;
		}
		//事务处理判断
		if(!$error){
			$DB->commit();
            return 1;
		}else{
			$DB->rollback();
            return 0;
		}

    }



}