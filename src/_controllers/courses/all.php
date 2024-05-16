<?
if (!session_id())
    session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
$ctrl = new Courses();
$ctrl->all();
