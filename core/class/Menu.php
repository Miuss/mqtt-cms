<?php

    class Menu {
		
		public function getMenu() {
            global $_GET;
            global $DB;

			$result = $DB->query("SELECT * FROM `menu`");
			while($info = $result->fetch_object()){
                if(($info->slug=="/".$_GET["page"]."/index")||($info->slug=="/"&&$_GET["page"]=="")) {
                    $active = " mdui-list-item-active";
                }else {
                    $active = "";
                }
            ?>
                <a href="<?php echo $info->slug;?>">
                    <li class="mdui-list-item mdui-ripple<?php echo $active;?>">
                        <i class="mdui-list-item-icon mdui-icon material-icons"><?php echo $info->icon;?></i>
                        <div class="mdui-list-item-content"><?php echo $info->name;?></div>
                    </li>
                </a>
            <?php }
        }

    }
?>