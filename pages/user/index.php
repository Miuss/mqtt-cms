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
                            <h1>用户管理</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-12">
                                <div class="device-btn-group mdui-float-left mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-color-white mdui-ripple" mdui-dialog="{target: '#CreateUser'}">创建新用户</button>
                                </div>
                                <div class="device-btn-group mdui-float-right mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-btn-icon mdui-color-white mdui-ripple"><i class="mdui-icon material-icons">refresh</i></button>
                                </div>
                                <div class="device-list mdui-table-fluid">
                                    <table class="mdui-table mdui-table-hoverable">
                                        <thead>
                                            <tr>
                                                <th>用户ID</th>
                                                <th>用户名</th>
                                                <th>账号状态</th>
                                                <th>近期登录时间</th>
                                                <th>创建时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mdui-text-center" colspan="6">载入中...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdui-dialog cms-dialog m-create-user" id="CreateUser">
            <button class="mdui-btn mdui-btn-icon close" mdui-dialog-close><i class="mdui-icon material-icons">close</i></button>
            <div class="mdui-dialog-title bg-block">
                创建新后台用户
            </div>
            <div class="form">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                    <label class="mdui-textfield-label">用户名称</label>
                    <input class="mdui-textfield-input" name="username" type="text" required>
                    <div class="mdui-textfield-error">用户名称不能为空</div>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                    <label class="mdui-textfield-label">用户密码</label>
                    <input class="mdui-textfield-input" name="password" type="password" required>
                    <div class="mdui-textfield-error">用户密码不能为空</div>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                    <label class="mdui-textfield-label">用户邮箱</label>
                    <input class="mdui-textfield-input" name="email" type="email" required>
                    <div class="mdui-textfield-error">用户邮箱格式不正确</div>
                </div>
                <div class="actions mdui-clearfix">
                    <div class="mdui-float-right">
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-create-user">立即创建</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
        <script>
            show_page(150);
            $.get("/api/?act=user-list",function(x) {
                var t = "";
                $.each(x.data,function(index,value){
                    t += "<tr><td>"+ 
                    value.id +"</td><td>"+ 
                    value.username +"</td><td>"+ 
                    (value.active==1?"<i class='mdui-icon material-icons status online'>fiber_manual_record</i> 正常":"<i class='mdui-icon material-icons status offine'>fiber_manual_record</i> 未启用") +"</td><td>"+ 
                    (value.last_activity?dateFormat("yyyy-MM-dd hh:mm:ss",value.last_activity):"未上线过") +"</td><td>"+ 
                    dateFormat("yyyy-MM-dd hh:mm:ss",value.regdate) +
                    "</td><td><a class='mdui-text-color-blue-800' href='/user/setting/"+ value.id +"'>账号管理</a></td></tr>";
                });
                $(".device-list tbody").html(t);
            });
        </script>
    </body>