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
                            <h1>MQTT管理</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-6">
                                <div class="mdui-card mdui-p-a-3">
                                    <h3 class="mdui-m-y-0 mdui-m-b-2">服务器状态</h3>
                                    <div class="mdui-table-fluid mdui-shadow-0">
                                        <table class="mdui-table mdui-table-hoverable">
                                            <tbody>
                                                <tr>
                                                    <td>MQTT服务器</td>
                                                    <td><span class="copy" copy="t1.bj.emqx.miuss.pro"><span>t1.bj.emqx.miuss.pro</span><i class="mdui-icon material-icons">content_copy</i></span></td>
                                                </tr>
                                                <tr>
                                                    <td>监控MQTT账号</td>
                                                    <td><span class="copy" copy="Status"><span>Status</span><i class="mdui-icon material-icons">content_copy</i></span></td>
                                                </tr>
                                                <tr>
                                                    <td>推送MQTT账号</td>
                                                    <td><span class="copy" copy="Publish"><span>Publish</span><i class="mdui-icon material-icons">content_copy</i></span></td>
                                                </tr>
                                                <tr>
                                                    <td mdui-tooltip="{content: '监控设备数据脚本运行状态'}">监控程序状态</td>
                                                    <td id="status"></td>
                                                </tr>
                                                <tr>
                                                    <td mdui-tooltip="{content: '推送数据至设备接口运行状态'}">推送程序状态</td>
                                                    <td id="publish"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mdui-col-md-6">
                                <div class="mdui-card mqtt-service mdui-p-a-3">
                                    <h3 class="mdui-m-y-0 mdui-m-b-2">平台监控&推送状态管理</h3>
                                    <div class="mdui-row">
                                        <div class="mdui-col-md-6">
                                            <div class="manage">
                                                <div class="icon">
                                                    <i class="mdui-icon material-icons mdui-text-color-blue">cloud_download</i>
                                                </div>
                                                <div class="name">数据监控服务</div>
                                                <div class="value"><i class="mdui-icon material-icons status online">fiber_manual_record</i>在线</div>
                                            </div>
                                        </div>
                                        <div class="mdui-col-md-6"> 
                                            <div class="manage">
                                                <div class="icon">
                                                    <i class="mdui-icon material-icons mdui-text-color-green">cloud_upload</i>
                                                </div>
                                                <div class="name">数据推送服务</div>
                                                <div class="value"><i class="mdui-icon material-icons status offine">fiber_manual_record</i>离线</div>
                                            </div>
                                        </div>
                                    </div>
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
            $.get("/api/?act=mqtt-service-status",function(x) {
                if(x.status=="error") {
                    warnings("获取MQTT监控程序状态失败，请检查平台是否正确部署");
                    $("#status").html("<i class='mdui-icon material-icons status offine'>fiber_manual_record</i> 离线");
                    $("#publish").html("<i class='mdui-icon material-icons status offine'>fiber_manual_record</i> 离线");
                    mdui.snackbar({message: x.msg,position: 'right-bottom'});
                }else{
                    $("#status").text(x.status-python);
                    $("#publish").text(x.publish-python);
                }
            });
        </script>
    </body>