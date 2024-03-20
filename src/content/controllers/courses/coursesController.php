<?php 
class coursesController{
    public function __construct()
    {
        
    }
    public function all()
    {
        require './content/views/courses/all-courses.php';
    }
}