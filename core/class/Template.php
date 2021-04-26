<?php
class Template {

    public $name;

    function __construct(){
        $this->name = 'default';
        $this->dir = dirname(__DIR__) . "../../template/".$this->name;
        $this->pename = 'default_pe';
    }

    // Get Template Name
    public function getName(){
        return $this->name;
    }

    public function getStatic() {
        return "/template/".$this->name."/static";
    }

    public function getHeader() {
        global $User;
        include_once $this->dir."/public/header.php";
    }

    public function getFooter() {
        global $User;
        include_once $this->dir."/public/footer.php";
    }
}
?>