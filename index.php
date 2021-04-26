<?php

include 'core/init.php';
include 'template/'.$Template->getName().'/public/head.php';

if(isset($_GET['page'])) {
	$_GET['page'] = htmlspecialchars($_GET['page'], ENT_QUOTES);
	$pages = glob('pages/' . '*.php');
	$pages = preg_replace('(pages/|.php)', '', $pages);

	if(isset($_GET['view'])) {
		$_GET['view'] = htmlspecialchars($_GET['view'], ENT_QUOTES);
		$views = glob('pages/'.$_GET['page'].'/' . '*.php');
		$views = preg_replace('(pages/'.$_GET['page'].'/|.php)', '', $views);

		if(in_array($_GET['view'], $views)) {
			include 'pages/'.$_GET['page'].'/'.$_GET['view'].'.php';
		} else {
			include 'pages/404.php';
		}
	}else if(in_array($_GET['page'], $pages)) {
		include 'pages/'.$_GET['page'].'.php';
	} else {
		include 'pages/404.php';
	}
} else {
	include 'pages/index.php';
}

include 'template/'.$Template->getName().'/public/footer.php';

include 'core/deinit.php';

?>
