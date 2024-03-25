<?php 
class coursesController{
    public function __construct()
    {
        
    }
    public function all()
    {
        require './content/views/courses/all-courses.php';
    }
    public function detail()
    {
        require './content/views/courses/course-single.php';
    }
    public function learn($courseID)
    {
        require './content/views/courses/learn.php';
    }
}