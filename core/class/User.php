<?php

    class User {

        public $islogin = 0;
        public $user_id = NULL;
        public $uinfo;
        public $isadmin = 0;

        public function __construct() {
            global $DB;
            global $Session;

            $user_id = $Session->get("uid");
            if(isset($user_id)&&$user_id!=false){
                $this->user_id = $user_id;
                $this->islogin = 1;
                $this->isadmin = $this->uinfo->admin;

                $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$this->user_id}'");
                $this->uinfo = $result->fetch_object();

            }else if(!empty($_COOKIE["code"])&&!empty($_COOKIE["uid"])){
                $this->cookie_login();
            }
        }

        public function cookie_login() {
            global $DB;
            global $Session;

            $user_id = $_COOKIE["uid"];
            $code = $_COOKIE["code"];
            
            $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$user_id}' AND `login_code` = '{$code}'");
            $info = $result->fetch_object();

            if($info==1){
                $Session->set("uid",$user_id,1*24*60*60);
                $Session->set("islogin",1,1*24*60*60);
                setcookie('uid', $user_id, time()+1*24*60*60,'/');
                setcookie('code', $code, time()+1*24*60*60,'/');

                $this->user_id = $user_id;
                $this->islogin = 1;
                $this->isadmin = $this->uinfo->admin;

                $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$this->user_id}'");
                $this->uinfo = $result->fetch_object();
            }
        }

        public static function salt() {
            return md5(time().rand(10,1000));
        }

        public function login($username,$password) {
            global $DB;
            global $Session;

            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $result = $DB->query("SELECT * FROM `users` WHERE `email` = '{$username}'");
            } else {
                $result = $DB->query("SELECT * FROM `users` WHERE `username` = '{$username}'");
            }
            
            $info = $result->fetch_object();

            if(!$info){
                return 0;
            }else if($info->password==md5($password.$info->salt)){    //判断密码是否正确
                $Session->set("uid",$info->id,1*24*60*60);
                $Session->set("islogin",1,1*24*60*60);
                $last_activity = time();
                $LOGIN_CODE = md5($info->email).md5($password).md5(time());
                $DB->query("UPDATE `users` SET `last_activity` = '{$last_activity}',`login_code` = '{$LOGIN_CODE}' WHERE `id` = '{$info->id}'");
                setcookie('uid', $info->id, time()+1*24*60*60,'/');
                setcookie('code', $LOGIN_CODE, time()+1*24*60*60,'/');
                return 2;
            }else{
                return 1;
            }
        }

        public function register($username,$password,$email) {
            global $DB;

            $salt = $this->salt();
            $password = md5($password.$salt);
            $regdate = time();
            $DB->query("INSERT INTO `users`(`username`,`password`, `email`, `salt`, `regdate`) VALUES ('{$username}','{$password}','{$email}','{$salt}','{$regdate}')");
            //重查数据库
            $result = $DB->query("SELECT * FROM `users` WHERE `email` = '{$email}' AND `username` = '{$username}'");
            $info = $result->fetch_object();
            if ($info > 0)
                return 1;
            else
                return 0;
        }
        
        public function resetpassword($uid,$password) {
            global $DB;
            
            $salt = $this->salt();
            $password = md5($password.$salt);
            
            $DB->query("UPDATE `users` SET `password` = '{$password}',`salt` = '{$salt}',`lost_pass_code` = '' WHERE `id` = '{$uid}'");
            //重查数据库
            $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$uid}' AND `password` = '{$password}'");
            $info = $result->fetch_object();
            if ($info > 0)
                return 1;
            else
                return 0;
        }

        public function logout() {
            global $Session;

            // 清除Session
            $Session->clearAll();
            
            // 清除Cookie
            setcookie('uid', '', time()-99,'/');
            setcookie('code', '', time()-99,'/');

        }
        
        public function getavatar($uid = NULL) {
            global $DB;

            if(isset($uid)){
                $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$uid}'");
                $info = $result->fetch_object();
                
                if($info->avatar!=NULL)
                    return $info->avatar;
                else
                    return "//tva1.sinaimg.cn/large/005zWjpngy1fv8ekbm0bxj30sg0sgdfm";
            }

            return "//tva1.sinaimg.cn/large/005zWjpngy1fv8ekbm0bxj30sg0sgdfm";
        }
        
        public function up_avatar($uid,$url) {
            global $DB;

            $DB->query("UPDATE `users` SET `avatar` = '{$url}' WHERE `id` = '{$uid}'");
            //重查数据库
            $result = $DB->query("SELECT * FROM `users` WHERE `id` = '{$uid}' AND `avatar` = '{$url}'");
            $info = $result->fetch_object();
            if ($info > 0)
                return 1;
            else
                return 0;
        }

        public function username_get_uid($username) {
            global $DB;

            $result = $DB->query("SELECT * FROM `users` WHERE `username` = '{$username}'");
            $info = $result->fetch_object();
            return $info->id;
        }

        public function email_get_uid($email) {
            global $DB;

            $result = $DB->query("SELECT * FROM `users` WHERE `email` = '{$email}'");
            $info = $result->fetch_object();
            return $info->id;
        }

    }
?>