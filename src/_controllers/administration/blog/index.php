<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/blog.php");
$ctrl = new AdminBlog();
$ctrl->index();
?>