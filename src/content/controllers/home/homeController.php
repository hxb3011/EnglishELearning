<?php
class homeController {

    public function __construct() {
        
    }

    public function index() {
        require_once './content/views/home/home.php';
    }
    public function contact()
    {
        require_once './content/views/home/contact.php';
    }
    public function faqs()
    {
        require_once './content/views/home/faqs.php';
    }
    public function blog(){
        require_once './content/views/blog/bloglist.php';
    }

}