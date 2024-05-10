<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
$ctrl = new Dictionary();

if(isset($_REQUEST['dictionary_search']))
{
    $word = $_REQUEST['dictionary_search'];
    call_user_func(array($ctrl,"detail"),$word);
}
else
{
    $ctrl->dictionary();
}
?>