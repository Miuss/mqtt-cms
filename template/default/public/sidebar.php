            <div id="sidebar" class="mdui-drawer mdui-color-white">
                <div class="mdui-card user-card mdui-ripple">
                    <a href="/user/setting">
                        <div class="mdui-card-header">
                            <img class="mdui-card-header-avatar" src="<?php echo $User->getavatar($User->user_id);?>"/>
                            <div class="mdui-card-header-title"><?php echo $User->uinfo->username;?></div>
                            <div class="mdui-card-header-subtitle">管理员</div>
                        </div>
                    </a>
                </div>

                <div class="mdui-list" mdui-collapse="{accordion: true}">
                    <?php $Menu->getMenu(); ?>
                    <li class="mdui-list-item mdui-ripple action-logout">
                        <i class="mdui-list-item-icon mdui-icon material-icons">exit_to_app</i>
                        <div class="mdui-list-item-content">登出</div>
                    </li>
                </div>
            </div>