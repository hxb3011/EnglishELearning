<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
$ctrl = new AdminCourses();
$ctrl->sort_excercise_modal();