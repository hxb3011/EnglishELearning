<?php 
require_once "/var/www/html/_lib/utils/requir.php";
class Blog {
    public function __construct() {
        
    }
    public function all()
    {
        requirv("blog/bloglist.php");
        global $page;
        $page = new BlogListPage();
        requira("_layout.php");
    }
}