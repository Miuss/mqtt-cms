<?php
    if(!$User->islogin) {
        Redirect("/index.php?page=user&view=login");
    }
    $Device = new Device();
    $result = $Device->getDeviceList();
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
                            <h1>设备管理</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-12">
                                <div class="device-btn-group mdui-float-left mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-color-white mdui-ripple" mdui-dialog="{target: '#CreateDevice'}">创建新设备</button>
                                </div>
                                <div class="device-btn-group mdui-float-right mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-btn-icon mdui-color-white mdui-ripple act-refresh"><i class="mdui-icon material-icons">refresh</i></button>
                                </div>
                                <div class="device-list mdui-table-fluid">
                                    <table class="mdui-table mdui-table-hoverable">
                                        <thead>
                                            <tr>
                                                <th>设备ID</th>
                                                <th>设备名称</th>
                                                <th>创建时间</th>
                                                <th>最近上线时间</th>
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
        <div class="mdui-dialog cms-dialog" id="CreateDevice">
            <button class="mdui-btn mdui-btn-icon close" mdui-dialog-close><i class="mdui-icon material-icons">close</i></button>
            <div class="mdui-dialog-title bg-block">
                创建新设备
            </div>
            <div class="form">
                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                    <label class="mdui-textfield-label">设备名称</label>
                    <input class="mdui-textfield-input" name="name" type="text" required>
                    <div class="mdui-textfield-error">设备名称不能为空</div>
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label mdui-textfield-has-bottom mdui-textfield-not-empty">
                    <label class="mdui-textfield-label">设备密码</label>
                    <input class="mdui-textfield-input" name="password" type="password" required>
                    <div class="mdui-textfield-error">设备密码不能为空</div>
                    <div class="mdui-textfield-helper">设备密码为设备连接MQTT服务密码</div>
                </div>
                <div class="actions mdui-clearfix">
                    <div class="mdui-float-right">
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme action-btn-create-device">立即创建</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
        <script>
            show_page(150);
            $.get("/api/?act=device-list",function(x) {
                var t = "";
                $.each(x.data,function(index,value){
                    t += "<tr><td>"+ 
                    value.id +"</td><td>"+ 
                    value.name +"</td><td>"+ 
                    timestampToTime(value.createtime) +"</td><td>"+ 
                    (value.onlinetime?timestampToTime(value.onlinetime):"未上线过") +
                    "</td><td><a class='mdui-text-color-blue-800' href='/device/setting/"+ value.id +"'>设备管理</a></td></tr>";
                });
                $(".device-list tbody").html(t);
            });

            $(".device-btn-group .act-refresh").on("click", function() {
                $(".device-list tbody").html('<tr><td class="mdui-text-center" colspan="6">载入中...</td></tr>');
                $.get("/api/?act=device-list",function(x) {
                    var t = "";
                    $.each(x.data,function(index,value){
                        t += "<tr><td>"+ 
                        value.id +"</td><td>"+ 
                        value.name +"</td><td>"+ 
                        timestampToTime(value.createtime) +"</td><td>"+ 
                        (value.onlinetime?timestampToTime(value.onlinetime):"未上线过") +
                        "</td><td><a class='mdui-text-color-blue-800' href='/device/setting/"+ value.id +"'>设备管理</a></td></tr>";
                    });
                    $(".device-list tbody").html(t);
                });
            });
        </script>
    </body>