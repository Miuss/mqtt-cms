<?php
    if(!$User->islogin) {
        Redirect("/user/login");
    }
    $Device = new Device();
    $info = $Device->getDeviceData($_GET["device"]);
    if(!$info) {
        $Session->set("success","该设备不存在");
        Redirect("/device/index");
    }
    $chart = $Device->getDeviceTCharts($_GET["device"]);
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
                            <h1><a href="/device/index"><i class="mdui-icon material-icons">arrow_back</i> 设备<?php echo $info->id;?></a></h1>
                        </div>
                        <div class="device-btn-group mdui-float-right mdui-m-b-1">
                            <button class="mdui-btn mdui-btn-border mdui-btn-border-radius-0 mdui-color-white mdui-ripple"><i class="mdui-icon mdui-text-icon material-icons">power_settings_new</i> 关机</button>
                        </div>
                        <div class="mdui-row mdui-m-t-2">
                            <div class="mdui-col-md-12">
                                <div class="mdui-card mdui-p-a-3">
                                    <h3 class="mdui-m-b-3 mdui-m-t-0">基本信息</h3>
                                    <div class="show-configuration-box">
                                        <div class="configuration-item">
											<span class="config-name">设备ID</span>
											<span class="config-value copy" id="deviceId" copy="<?php echo $info->id;?>"><span><?php echo $info->id;?></span><i class="mdui-icon material-icons">content_copy</i></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">设备名称</span>
											<span class="config-value edit" id="deviceName"><span><?php echo $info->name;?></span><edit>编辑</edit></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">设备状态</span>
											<span class="config-value" id="deviceStatus"><?php echo $info->online?"<i class='mdui-icon material-icons status online'>fiber_manual_record</i> 在线":"<i class='mdui-icon material-icons status offine'>fiber_manual_record</i> 离线";?></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">设备账号</span>
											<span class="config-value copy" id="deviceUsername" copy="<?php echo $info->mqtt_username;?>"><span><?php echo $info->mqtt_username;?></span><i class="mdui-icon material-icons">content_copy</i></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">订阅TOPIC</span>
											<span class="config-value copy" id="setTopic" copy="<?php echo $info->mqtt_topic_set;?>"><span><?php echo $info->mqtt_topic_set;?></span><i class="mdui-icon material-icons">content_copy</i></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">推送TOPIC：</span>
											<span class="config-value copy" id="postTopic" copy="<?php echo $info->mqtt_topic_post;?>"><span><?php echo $info->mqtt_topic_post;?></span><i class="mdui-icon material-icons">content_copy</i></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">创建时间：</span>
											<span class="config-value" id="createTime"><?php echo date("Y-m-d H:i:s",$info->createtime);?></span>
										</div>
                                        <div class="configuration-item">
											<span class="config-name">近期上线时间：</span>
											<span class="config-value" id="onlineTime"><?php echo date("Y-m-d H:i:s",$info->onlinetime);?></span>
										</div>
									</div>
                                </div>
                                <div class="mdui-row">
                                    <div class="mdui-col-md-4">
                                        <div class="mdui-card stats-card device-card quantity_of_refuse">
                                            <div class="icon">
                                                <i class="mdui-icon material-icons">delete_sweep</i>
                                            </div>
                                            <div class="content">
                                                <div class="title">垃圾量(百分比)</div>
                                                <div class="value"><span class="num"><?php echo $info->data->quantity_of_refuse;?></span>%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdui-col-md-4">
                                        <div class="mdui-card stats-card device-card humidity">
                                            <div class="icon">
                                                <i class="mdui-icon material-icons">invert_colors</i>
                                            </div>
                                            <div class="content">
                                                <div class="title">湿度</div>
                                                <div class="value"><span class="num"><?php echo $info->data->humidity;?></span>%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdui-col-md-4">
                                        <div class="mdui-card stats-card device-card T">
                                            <div class="icon">
                                                <i class="mdui-icon material-icons">wb_sunny</i>
                                            </div>
                                            <div class="content">
                                                <div class="title">温度</div>
                                                <div class="value"><span class="num"><?php echo $info->data->T;?></span>°C</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdui-col-md-12">
                                        <div class="mdui-card mdui-p-a-3">
                                            <h3 class="mdui-m-b-3 mdui-m-t-0">设备温度监控图表</h3>
                                            <div id="T-chart"></div>
                                        </div>
                                    </div>
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
        <script src="https://lib.baomitu.com/highstock/6.0.3/highstock.js"></script>
        <script src="https://cdn.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
        <script>
            show_page(150);
            self.setInterval(function() {
                $.get("/api/?act=device-data&device=<?php echo $info->id;?>",function(x){
                    $("#deviceId").attr("copy",x.data.id);
                    $("#deviceId span").html(x.data.id);
                    $("#deviceName span").html(x.data.name);
                    $("#deviceStatus").html(x.data.online?"<i class='mdui-icon material-icons status online'>fiber_manual_record</i> 在线":"<i class='mdui-icon material-icons status offine'>fiber_manual_record</i> 离线");
                    $("#deviceUsername").attr("copy",x.data.mqtt_username);
                    $("#deviceUsername span").html(x.data.mqtt_username);
                    $("#setTopic").attr("copy",x.data.mqtt_topic_set);
                    $("#setTopic span").html(x.data.mqtt_topic_set);
                    $("#postTopic").attr("copy",x.data.mqtt_topic_post);
                    $("#postTopic span").html(x.data.mqtt_topic_post);
                    $("#createTime").html(dateFormat("yyyy-MM-dd hh:mm:ss",x.data.createtime));
                    $("#onlineTime").html(dateFormat("yyyy-MM-dd hh:mm:ss",x.data.onlinetime));
                    $(".device-card.quantity_of_refuse .value .num").html(x.data.data.quantity_of_refuse);
                    $(".device-card.humidity .value .num").html(x.data.data.humidity);
                    $(".device-card.T .value .num").html(x.data.data.T);
                });
            },5000);
        </script>
                <script>
                    var chartdata = <?php echo $chart->chartdata;?>;

                    Highcharts.setOptions({
                        global: {
                            useUTC: false
                        }
                    });

                    var chart1 = Highcharts.stockChart('T-chart', {
                        chart: {
                            type: "area",
                            style: {
                                fontFamily: "'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif",
                                fontSize: "12px",
                                fontWeight: "bold"
                            },
                            backgroundColor: "#ffffff",
                            borderColor: "rgb(55,71,79,.6)",
                        },
                        rangeSelector: {
                            buttonTheme: {
                                width: "100px",
                                stroke: 'none',
                                style: {
                                    color: '#37474f',
                                    fontWeight: 'bold'
                                },
                                states: {
                                    hover: {
                                    },
                                    select: {
                                        fill: '#37474f',
                                        style: {
                                            color: 'white'
                                        }
                                    },
                                    disabled: {
                                        fill: '#fff',
                                        style: {
                                            color: '#37474f'
                                        }
                                    }
                                }
                            },
                            selected: 0,
                            buttons: [{
                                type: 'minute',
                                count: 1,
                                text: '1分钟',
                                dataGrouping: {
                                    forced: true,
                                    units: [['second', [5]]]
                                }
                            },{
                                type: 'hour',
                                count: 24,
                                text: '24小时',
                                dataGrouping: {
                                    forced: true,
                                    units: [['minute', [5]]]
                                }
                            }, {
                                type: 'day',
                                count: 7,
                                text: '7天',
                                dataGrouping: {
                                    forced: true,
                                    units: [['minute', [10]]]
                                }
                            }, {
                                type: 'day',
                                count: 30,
                                text: '1个月',
                                dataGrouping: {
                                    forced: true,
                                    units: [['minute', [30]]]
                                }
                            }],
                        },
                        title: {
                            text: ''
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                showInLegend: true
                            }
                        },
                        tooltip: {
                            split: false,
                            shared: true,
                            valueDecimals: 0,
                            valueSuffix: '°C'
                        },
                        xAxis: {
                            title: {
                                text: null
                            },
                            lineWidth: 0,
                            labels: {
                                enabled: true
                            },
                            gridLineWidth: 0,
                            tickLength: 0,
                            tickWidth: 0,
                            type: "datetime",
                            dateTimeLabelFormats: {
                                millisecond: '%H:%M:%S.%L',
                                second: '%H:%M:%S',
                                minute: '%H:%M',
                                hour: '%H:%M',
                                day: '%m月%e日',
                                week: '%e. %b',
                                month: '%b \'%y',
                                year: '%Y'
                            }
                        },
                        yAxis: {
                            title: {
                                text: null
                            },
                            labels: {
                                enabled: true
                            },
                            gridLineWidth: 0
                        },
                        scrollbar: {
                            barBackgroundColor: '#37474f',
                            barBorderWidth: 0,
                            buttonBackgroundColor: '#37474f',
                            buttonBorderWidth: 0,
                            buttonArrowColor: '#ffffff',
                            rifleColor: '#ffffff',
                            rifleBorderWidth: 0,
                            trackBackgroundColor: 'rgb(55,71,79,.6)',
                            trackBorderWidth: 0,
                            rifleColor: '#ffffff',
                        },
                        navigator: {
                            outlineColor: 'rgb(55,71,79,.6)',
                            outlineWidth: 0
                        },
                        series: [{
						    type: 'area',
                            name: '温度',
                            color: "#37474f",
                            fillColor: "rgb(55,71,79,.3)",
                            data: chartdata
                        }]
                    });
                </script>
    </body>