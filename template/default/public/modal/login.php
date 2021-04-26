        <div class="mdui-dialog m-profile m-login" id="dialog-login">
            <button class="mdui-btn mdui-btn-icon close" mdui-dialog-close><i class="mdui-icon material-icons">close</i></button>
            <div class="mdui-dialog-title bg-block">登录</div>
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
                    <button class="mdui-btn mdui-ripple more-option" type="button" mdui-menu="{target: '#mc-login-menu', position: 'top', covered: true}">更多选项<i class="mdui-icon material-icons mdui-text-color-theme-icon">arrow_drop_down</i></button>
                    <ul class="mdui-menu" id="mc-login-menu">
                        <li class="mdui-menu-item">
                            <a class="mdui-ripple btn-forget-pass" mdui-dialog="{target: '#dialog-resetpass'}" mdui-dialog-close>忘记密码</a>
                        </li>
                        <li class="mdui-menu-item">
                            <a class="mdui-ripple btn-register" mdui-dialog="{target: '#dialog-register'}" mdui-dialog-close>创建新账号</a>
                        </li>
                    </ul>
                    <div class="mdui-float-right">
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-login">登录</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdui-dialog m-profile m-register" id="dialog-register">
            <div class="step-1">
                <button class="mdui-btn mdui-btn-icon close" mdui-dialog-close><i class="mdui-icon material-icons">close</i></button>
                <div class="mdui-dialog-title bg-block">注册</div>
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
                        <button class="mdui-btn mdui-ripple more-option" mdui-dialog="{target: '#dialog-login'}" mdui-dialog-close>已有账号？</button>
                        <div class="mdui-float-right">
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-light-green-800 action-btn-check">下一步</button>
                        </div>
                    </div>
                </div>      
            </div>
            <div class="step-2">
                <button class="mdui-btn mdui-btn-icon back"><i class="mdui-icon material-icons">arrow_back</i></button>
                <div class="mdui-dialog-title bg-block">注册</div>
                <div class="form">
                    <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                        <label class="mdui-textfield-label">用户名</label>
                        <input class="mdui-textfield-input" name="username" type="text" required="">
                        <div class="mdui-textfield-error">用户名不能为空</div>
                    </div>
                    <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                        <label class="mdui-textfield-label">密码</label>
                        <input class="mdui-textfield-input" name="password" type="password" required="">
                        <div class="mdui-textfield-error">密码不能为空</div>
                    </div>
                    <div class="actions mdui-clearfix">
                        <div class="mdui-float-right">
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-light-green-800 action-btn-register">注册</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdui-dialog m-profile m-resetpass" id="dialog-resetpass">
            <div class="step-1">
                <button class="mdui-btn mdui-btn-icon close" mdui-dialog-close><i class="mdui-icon material-icons">close</i></button>
                <div class="mdui-dialog-title bg-block">找回密码</div>
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
                        <button class="mdui-btn mdui-ripple more-option" mdui-dialog="{target: '#dialog-login'}" mdui-dialog-close>已有账号？</button>
                        <div class="mdui-float-right">
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-brown-800 action-btn-check">下一步</button>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="step-2">
                <button class="mdui-btn mdui-btn-icon back"><i class="mdui-icon material-icons">arrow_back</i></button>
                <div class="mdui-dialog-title bg-block">找回密码</div>
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
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-brown-800 action-btn-resetpass">重置密码</button>
                        </div>
                    </div>
                </div>   
            </div>
        </div>