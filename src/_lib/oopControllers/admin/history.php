<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/SubscriptionModel.php');

class History
{
    public SubscriptionModel $subscription;
    function __construct()
    {
        $this->subscription = new SubscriptionModel();
    }
    /* */
    public function index()
    {
        requirv("admin/history/CheckoutHistoryPage.php");
        global $page;
        $page = new CheckoutHistoryPage();
        requira("_adminLayout.php");

    }   
    /* ajax */
    public function get_all()
    {
        $arr = array();
        $arr['data'] = $this->subscription->get_all();
        echo json_encode($arr);
    }
}
