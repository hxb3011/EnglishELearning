<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
$ctrl = new AdminDictionary();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ctrl->addLemma();
} 
    else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        $ctrl->add();
    } else {
        header('Location: /error');
    }
