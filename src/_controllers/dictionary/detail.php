<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
$word = $_REQUEST['dictionary_search'];
$ctrl = new Dictionary();
if(isset($word))
{
    call_user_func(array($ctrl,$detail),$word);
}
?>