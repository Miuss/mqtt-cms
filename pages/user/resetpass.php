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
                    <div class="mdui-card m-profile m-resetpass" id="dialog-resetpass">
                        <div class="step-1">
                            <div class="mdui-card-title bg-block">找回密码</div>
                            <div class="form">
                                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                                    <label class="mdui-textfield-label">邮箱</label>
                                    <input class="mdui-textfield-input" name="email" type="email" required="">
                                    <div class="mdui-textfield-error">邮箱格式错误</div>
                                </div>
                                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty send-email-field">
                                    <label class="mdui-textfield-label">验证码</label>
                                    <input class="mdui-textfield-input" name="code" type="text" required="">
                                    <div class="mdui-textfield-error">验证码不能为空</div>
                                    <button class="mdui-btn send-email" type="button">发送验证码</button>
                                </div>
                                <div class="actions mdui-clearfix">
                                    <a class="mdui-btn mdui-ripple more-option" href="/index.php?page=user&view=login">已有账号？</a>
                                    <div class="mdui-float-right">
                                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-check">下一步</button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="step-2">
                            <button class="mdui-btn mdui-btn-icon back"><i class="mdui-icon material-icons">arrow_back</i></button>
                            <div class="mdui-card-title bg-block">找回密码</div>
                            <div class="form">
                                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                                    <label class="mdui-textfield-label">密码</label>
                                    <input class="mdui-textfield-input" name="password" type="password" required="">
                                    <div class="mdui-textfield-error">密码不能为空</div>
                                </div>
                                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                                    <label class="mdui-textfield-label">重复密码</label>
                                    <input class="mdui-textfield-input" name="repassword" type="password" required="">
                                    <div class="mdui-textfield-error">重复密码不能为空</div>
                                </div>
                                <div class="actions mdui-clearfix">
                                    <div class="mdui-float-right">
                                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-resetpass">重置密码</button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
    </body>