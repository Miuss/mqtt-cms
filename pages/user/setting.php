<?php
    if(!$User->islogin) {
        Redirect("/user/login");
    }
?>
    <body class="mdui-appbar-with-toolbar mdui-theme-primary-blue-grey mdui-shadow-0 mdui-loaded mdui-drawer-body-left">
        <?php $Template->getHeader(); ?>
        <div class="mdui-container">
            <div class="mdui-row">
                <div class="mdui-col-md-12">
                    <div class="page-loading">
                        <div class="mdui-spinner"></div>
                    </div>
                    <div class="page-content">
                        <div class="page-heading">
                            <h1>账号设置</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-6">
                                <div class="mdui-card">
                                    <div class="mdui-card-header">
                                        <img class="mdui-card-header-avatar" src="<?php echo $User->getavatar($User->user_id);?>"/>
                                        <div class="mdui-card-header-title"><?php echo $User->uinfo->username;?></div>
                                        <div class="mdui-card-header-subtitle">管理员</div>
                                    </div>
                                    <div class="mdui-card-content user-info mdui-p-y-0">
                                        <dl>
                                            <dt>用户名: </dt>
                                            <dd><?php echo $User->uinfo->username;?></dd>
                                            <dt>邮箱: </dt>
                                            <dd><?php echo $User->uinfo->email;?></dd>
                                            <dt>账号状态: </dt>
                                            <dd><?php echo $User->uinfo->active?"正常":"不可用";?></dd>
                                            <dt>近期登录:</dt>
                                            <dd><?php echo date("Y-m-d H:i:s",$User->uinfo->last_activity);?></dd>
                                            <dt>注册时间:</dt>
                                            <dd><?php echo date("Y-m-d H:i:s",$User->uinfo->regdate);?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="mdui-col-md-6">
                                <div class="mdui-card user-edit mdui-p-a-3">
                                    <div class="mdui-card-primary-title">更改帐户密码</div>
                                    <div class="mdui-textfield">
                                        <label class="mdui-textfield-label">旧密码 <span class="mdui-text-color-red">*</span></label>
                                        <input class="mdui-textfield-input" type="password" name="oldpassword"/>
                                    </div>
                                    <div class="mdui-textfield">
                                        <label class="mdui-textfield-label">新密码</label>
                                        <input class="mdui-textfield-input" type="password" name="newpassword"/>
                                    </div>
                                    <div class="mdui-textfield">
                                        <label class="mdui-textfield-label">确认新密码</label>
                                        <input class="mdui-textfield-input" type="password" name="renewpassword"/>
                                    </div>
                                    <button class="mdui-btn mdui-btn-block mdui-color-theme save-user-security">点击修改</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
        <script>
            show_page(150);
        </script>
    </body>