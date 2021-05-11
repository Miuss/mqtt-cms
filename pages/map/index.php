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
                            <h1>路线管理</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-12">
                                <div class="device-btn-group mdui-float-left mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-color-white mdui-ripple">创建新路线</button>
                                </div>
                                <div class="device-btn-group mdui-float-right mdui-m-b-1">
                                    <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-btn-icon mdui-color-white mdui-ripple"><i class="mdui-icon material-icons">refresh</i></button>
                                </div>
                                <div class="device-list mdui-table-fluid">
                                    <table class="mdui-table mdui-table-hoverable">
                                        <thead>
                                            <tr>
                                                <th>路线ID</th>
                                                <th>路线名称</th>
                                                <th>路线设备数量</th>
                                                <th>创建时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mdui-text-center" colspan="5">载入中...</td>
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
        <script src="<?php echo $Template->getStatic();?>/js/main.js"></script>
        <script>
            show_page(150);
        </script>
    </body>