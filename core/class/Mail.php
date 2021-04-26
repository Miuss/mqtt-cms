<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

class Email{
 
    public static function sendEmail($email,$title,$body){
        $mail = new PHPMailer(true);
        try {
 
            //使用STMP服务
            $mail->isSMTP();
 
            //这里使用我们第二步设置的stmp服务地址
            $mail->Host = 'smtp.exmail.qq.com';
 
            //设置是否进行权限校验
            $mail->SMTPAuth = true;
 
            //第二步中登录网易邮箱的账号
            $mail->Username = 'i@e.mcstatus.cn';
 
            //客户端授权密码，注意不是登录密码
            $mail->Password = 'e6hq9EXDEG3Cypk8';
 
            //使用ssl协议
            $mail->SMTPSecure = 'ssl';
 
            //端口设置
            $mail->Port = '465';
 
            //字符集设置，防止中文乱码
            $mail->CharSet= "utf-8";
 
            //设置邮箱的来源，邮箱与$mail->Username一致，名称随意
            $mail->setFrom('i@e.mcstatus.cn','McStatus游戏社区');
 
            //设置收件的邮箱地址
            $mail->addAddress($email);
 
            //设置回复地址，一般与来源保持一直
            $mail->addReplyTo('i@e.mcstatus.cn','McStatus游戏社区');
 
            $mail->isHTML(true);
            //标题
            $mail->Subject = $title;
            //正文
            $mail->Body = $body;
            $mail->send();
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}
?>