<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/blog.php");
$ctrl = new AdminBlog();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->edit_post();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_REQUEST['courseId'])) {
        $ctrl->edit($_REQUEST['courseId']);
    } else {
        header('Location: /error');
    }
}
