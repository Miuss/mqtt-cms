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
				case "servers": 
					$pagetitle = "我的世界服务器列表_";break;
				case "server":
					$pagetitle = $server->data->name."_";break;
				case "servers_tag":
					$pagetitle = $servers_tag->data->name."_";break;
				case "user":
					switch($get["view"]){
						case "login" :
							$pagetitle = "登录_";break;
						case "register" :
							$pagetitle = "注册_";break;
						case "forgetpass" :
							$pagetitle = "密码找回_";break;
						case "space" :
							$uid = $get["uid"];
							$result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$uid}'");
							$data = $result->fetch_object();
							$pagetitle = $data->username."的个人主页_";break;
						case "setting" : 
							$pagetitle = "个人资料_";break;
					}
					case "console":
						switch($get["view"]){
							case "index" :
								$pagetitle = "服务器管理_";break;
							case "server" :
								$sid = $get["sid"];
								$result = $DB->query("SELECT * FROM `servers` WHERE `id` = '{$sid}'");
								$data = $result->fetch_object();
								$pagetitle = $data->name."管理面板_";break;
							case "server-edit" : 
								$sid = $get["sid"];
								$result = $DB->query("SELECT * FROM `servers` WHERE `id` = '{$sid}'");
								$data = $result->fetch_object();
								$pagetitle = "信息修改_".$data->name."_";break;
							case "server-data" : 
								$sid = $get["sid"];
								$result = $DB->query("SELECT * FROM `servers` WHERE `id` = '{$sid}'");
								$data = $result->fetch_object();
								$pagetitle = "大数据_".$data->name."_";break;
						}
			}
			return $pagetitle.$this->title;
		}

    }
?>