<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
$ctrl = new AdminDictionary();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ctrl->editLemma();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_REQUEST['lemmaID'])) {
        $ctrl->edit($_REQUEST['lemmaID']);
    } else {
        header('Location: /error');
    }
}