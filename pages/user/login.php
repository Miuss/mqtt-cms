<?php
    if($User->islogin) {
        $Session->set("success","您已登录过了");
        Redirect("/");
    }
?>
    
    <body class="mdui-appbar-with-toolbar mdui-theme-primary-blue-grey mdui-shadow-0 mdui-loaded">
        <div class="mdui-container">
            <div class="mdui-row">
                <div class="mdui-col-md-12">
                    <div class="mdui-card m-profile m-login" id="dialog-login">
                        <div class="mdui-card-title bg-block">
                            防疫垃圾桶控制台登录
                        </div>
                        <div class="form">
                            <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                                <label class="mdui-textfield-label">用户名或邮箱</label>
                                <input class="mdui-textfield-input" name="username" type="text" required>
                                <div class="mdui-textfield-error">账号不能为空</div>
                            </div>
                            <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                                <label class="mdui-textfield-label">密码</label>
                                <input class="mdui-textfield-input" name="password" type="password" required>
                                <div class="mdui-textfield-error">密码不能为空</div>
                            </div>
                            <div class="actions mdui-clearfix">
                                <a class="mdui-btn mdui-ripple more-option" href="/user/resetpass">忘记密码？</a>
                                <div class="mdui-float-right">
                                <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-login">登录</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
    </body>