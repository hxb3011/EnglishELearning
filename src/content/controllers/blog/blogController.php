<?php 
class blogController {
    public function __construct() {
        
    }
    public function all()
    {
        require './content/views/blog/bloglist.php';
    }
}