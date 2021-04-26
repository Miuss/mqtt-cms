<?php
    if(!$User->islogin) {
        Redirect("/index.php?page=user&view=login");
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
                            <h1>仪表盘</h1>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-3">
                                <div class="mdui-card stats-card device-card">
                                    <div class="icon">
                                        <i class="mdui-icon material-icons">kitchen</i>
                                    </div>
                                    <div class="content">
                                        <div class="title">在线设备数</div>
                                        <div class="value"><span class="online">10</span><b>/<span class="num">12<span></b></div>
                                    </div>
                                    <div class="mdui-progress">
                                        <div class="mdui-progress-determinate" style="width: 100%;"></div>
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
            $.get("/api/?act=getdashboard&t="+new Date().getTime(),function(x){
                $(".device-card .value .online").html(x.device.online);
                $(".device-card .value .num").html(x.device.num);
                $(".device-card .mdui-progress-determinate").css("width", x.device.online/x.device.num*100 +"%");

                show_page(150);
            });
            self.setInterval(function() {
                $.get("/api/?act=getdashboard&t="+new Date().getTime(),function(x){
                    $(".device-card .value .online").html(x.device.online);
                    $(".device-card .value .num").html(x.device.num);
                    $(".device-card .mdui-progress-determinate").css("width", x.device.online/x.device.num*100 +"%");
                });
            },5000);
        </script>
    </body>