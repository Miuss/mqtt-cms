<?php

class MQTT {

    public function getMQTTInfo() {
        global $DB;

        $result = $DB->query("SELECT * FROM `devices`");
        $info = $result->fetch_object();

    }

    public function getMQTTServiceStatus() {
        $shell = "../status.sh";
        exec($shell, $result, $status);
        if($status){
            return null;
        }else{
            $data = new stdClass;
            if($result[0]=="status: online"){
                $data->status = 1; 
            }else{
                $data->status = 0; 
            }
            if($result[1]=="publish: online"){
                $data->publish = 1; 
            }else{
                $data->publish = 0; 
            }
            return $data;
        }
    }


}