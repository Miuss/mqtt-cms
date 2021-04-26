            <div id="sidebar" class="mdui-drawer mdui-color-white">
                <div class="mdui-card user-card mdui-ripple">
                    <div class="mdui-card-header">
                        <img class="mdui-card-header-avatar" src="<?php echo $User->getavatar($User->user_id);?>"/>
                        <div class="mdui-card-header-title"><?php echo $User->uinfo->username;?></div>
                        <div class="mdui-card-header-subtitle">管理员</div>
                    </div>
                </div>

                <div class="mdui-list" mdui-collapse="{accordion: true}">
                    <li class="mdui-list-item mdui-ripple mdui-list-item-active">
                        <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                        <div class="mdui-list-item-content">仪表盘</div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">kitchen</i>
                        <div class="mdui-list-item-content">设备管理</div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">map</i>
                        <div class="mdui-list-item-content">路线管理</div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">dns</i>
                        <div class="mdui-list-item-content">MQTT管理</div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">equalizer</i>
                        <div class="mdui-list-item-content">大屏监控</div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">settings</i>
                        <div class="mdui-list-item-content">站点设置</div>
                    </li>
                </div>
            </div>