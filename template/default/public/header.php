        <header class="mdui-appbar mdui-appbar-fixed mdui-color-theme-800">
            <div class="mdui-toolbar mdui-text-color-white">
                <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-black menu close"
                      mdui-drawer="{target: '#sidebar', swipe: true}">
                    <i class="mdui-icon material-icons icon">menu</i>
                </span>
                <a href="/" class="mdui-typo-headline mdui-hidden-xs">防疫机器人监控后台</a>
                <a href="/" class="mdui-typo-title">首页</a>
                <form method="get" class="search-bar">
                    <button type="button" class="back mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">arrow_back</i></button>
                    <button type="submit" class="submit mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input type="text" placeholder="搜索设备或路线">
                    <button type="button" class="cancel mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                </form>
                <div class="mdui-toolbar-spacer"></div>
                <div class="search-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></div>
            </div>
        </header>
        <?php include 'sidebar.php'; ?>