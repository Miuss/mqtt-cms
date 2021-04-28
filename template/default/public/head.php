<!DOCTYPE html>
<html lang="zh-cmn-Hans">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
        <meta name="renderer" content="webkit"/>
        <meta name="force-rendering" content="webkit"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title><?php echo $Title->getTitle($_GET);?></title>
        <!-- MDUI CSS -->
        <link rel="stylesheet" href="<?php echo $Template->getStatic();?>/mdui/css/mdui.min.css">
        <link rel="stylesheet" href="<?php echo $Template->getStatic();?>/css/style.css">
        <!-- JavaScript -->
        <script src="<?php echo $Template->getStatic();?>/mdui/js/mdui.min.js"></script>
        <script src="https://lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
        <?php display_notifications(); ?>
    </head>