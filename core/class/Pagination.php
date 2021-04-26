<?php
 
class Pagination {
	public 	$per_page,
			$current_page,
			$total_pages,
			$limit,
			$current_page_link,
			$link;

	public function __construct($per_page, $where) {
		global $DB;

		/* Initiate the $per_page variable */
		$this->per_page = $per_page;

		/* Get the total servers count */
		$result = $DB->query("SELECT COUNT(*) AS `count` FROM `servers` {$where}");
		$info = $result->fetch_object();
		$total_servers = $info->count;

		/* Determine the number of total pages */
		$this->total_pages = ceil($total_servers/$this->per_page);

		/* Determine the current page and check for errors */
		$this->current_page = (isset($_GET['current_page'])) ? (int)$_GET['current_page'] : 1;

		/* Check if the current page number is less than 1 or higher than the $total_pages */
		$this->current_page = ($this->current_page < 1 || $this->current_page > $this->total_pages) ? $this->current_page : $this->current_page;

		/* Generate the limit query */
		$this->limit = "LIMIT " . ($this->current_page - 1) * $this->per_page . "," . $this->per_page;

	}

	public function set_current_page_link($current_page_link) {

		/* Initiate the $current_page_link variable */
		$this->current_page_link = $current_page_link;

		/* Generate the $link without any affix */
		$this->link = $this->current_page_link . '/' . $this->current_page;

	}

	public function display($affix = null, $aside = 5) {
		$o = $this->current_page;

			/* Create the next and the previous variables */
			$previous = $this->current_page - 1;
			$next = $this->current_page + 1;

			/* Start generating the links */
			$pagination = '<div class="pagination mdui-m-t-1">';

			/* Previous button */
			$pagination .= ($this->current_page != 1) ? '<div class="mdui-col-xs-6 mdui-p-a-0"><a class="previous mdui-float-left" title="" href="' . $this->current_page_link . '/' . $previous . $affix . '.html"><button class="mdui-btn mdui-btn-icon mdui-color-white mdui-text-color-theme mdui-chip mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button></a></div>' : '<div class="mdui-col-xs-6 mdui-p-a-0"><a class="previous mdui-float-left" title="" href="' . $this->current_page_link . '/' . $this->current_page . '.html"><button class="mdui-btn mdui-btn-icon mdui-color-white mdui-text-color-theme mdui-chip mdui-ripple" disabled><i class="mdui-icon material-icons">arrow_back</i></button></a></div>';

			/* Next button */
			$pagination .= ($this->current_page != $this->total_pages) ? '<div class="mdui-col-xs-6 mdui-p-a-0"><a class="next mdui-float-right" title="" href="' . $this->current_page_link . '/' . $next . $affix . '.html"><button class="mdui-btn mdui-btn-icon mdui-color-white mdui-text-color-theme mdui-chip mdui-ripple"><i class="mdui-icon material-icons">arrow_forward</i></button></a></div>' : '<div class="mdui-col-xs-6 mdui-p-a-0"><a class="next mdui-float-right" title="" href="' . $this->current_page_link . '/' . $this->current_page . '.html"><button class="mdui-btn mdui-btn-icon mdui-color-white mdui-text-color-theme mdui-chip mdui-ripple" disabled><i class="mdui-icon material-icons">arrow_forward</i></button></a></div>';


			$pagination .= '</div>';

		echo $pagination;
	}

}
?>
