<?
require_once "www/var/html/_lib_utils/requir.php" ;
requirl("oopControllers/admin/blog.php");
requirm("/access/Blog.php");
$ctrl = new AdminBlog();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->add_post();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ctrl->add();
}
?>