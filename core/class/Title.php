<?php

    class Title {

        public $title = NULL;
        public $page = NULL;

        public function __construct() {
            global $DB;

			$result = $DB->query("SELECT * FROM `setting`");
			$data = $result->fetch_object();

			$this->title = $data->title;
			
		}
		
		public function getTitle($get) {
			global $DB;
			global $server;
			global $servers_tag;

			switch($get["page"]) {
				case "user":
					switch($get["view"]){
						case "login" :
							$pagetitle = "登录_";break;
						case "forgetpass" :
							$pagetitle = "密码找回_";break;
					}
				case "device":
					switch($get["view"]){
						case "index" :
							$pagetitle = "设备管理_";break;
						case "setting" :
							$device = $get["device"];
							$result = $DB->query("SELECT * FROM `devices` WHERE `id` = '{$device}'");
							$data = $result->fetch_object();
							$pagetitle = "设备".$data->id."_设备管理_";break;
					}
			}
			return $pagetitle.$this->title;
		}

    }
?>