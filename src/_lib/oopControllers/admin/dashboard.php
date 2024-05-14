<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/SubscriptionModel.php');

class DashboardService
{
    public SubscriptionModel $subscription;

    function __construct()
    {
        $this->subscription = new SubscriptionModel();
    }

    /* ajax */
    public function get_revenue_total($start_date, $end_date)
    {
        $arr = array();
        $arr['data'] = $this->subscription->get_revenue_total($start_date, $end_date);
        echo json_encode($arr);
    }

    public function get_buyed_course_total($start_date, $end_date){
        $arr = array();
        $arr['data'] = $this->subscription->get_buyed_course_total($start_date, $end_date);
        echo json_encode($arr);
    }

    public function get_total_account($start_date, $end_date){
        $arr = array();
        $arr['data'] = $this->subscription->get_total_account($start_date, $end_date);
        echo json_encode($arr);
    }

    public function get_details_revenue_by_date($start_date, $end_date){
        $arr = array();
        $arr['data'] = $this->subscription->get_details_revenue_by_date($start_date, $end_date);
        echo json_encode($arr);
    }

    public function get_top_revenue_by_teacher($start_date, $end_date, $view_teacher_quantity){
        $arr = array();
        $arr['data'] = $this->subscription->get_top_revenue_by_teacher($start_date, $end_date, $view_teacher_quantity);
        echo json_encode($arr);
    }

    public function get_total_student_by_teacher($start_date, $end_date, $teacher_id){
        $arr = array();
        $arr['data'] = $this->subscription->get_total_student_by_teachder($start_date, $end_date, $teacher_id);
        echo json_encode($arr);
    }

    public function get_top_seller_by_course($start_date, $end_date, $view_top_course_quantity){
        $arr = array();
        $arr['data'] = $this->subscription->get_top_seller_by_course($start_date, $end_date, $view_top_course_quantity);
        echo json_encode($arr);
    }

    public function get_last_day_have_revenue($start_date, $end_date){
        $arr = array();
        $arr['data'] = $this->subscription->get_last_day_have_revenue($start_date, $end_date);
        echo json_encode($arr);
    }
}
