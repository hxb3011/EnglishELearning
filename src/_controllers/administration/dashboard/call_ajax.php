<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dashboard.php");
$json = file_get_contents('php://input');
$ctrl = new DashboardService();
$data = json_decode($json, true);
$action = $data['action'];
$start_date = $data['start_date'];
$end_date = $data['end_date'];
// echo $action;
if(isset($action))
{
    if ($action == "get_total_student_by_teacher"){
        $teacher_id = $data['teacher_id'];
        call_user_func(array($ctrl,$action),$start_date,$end_date,$teacher_id);
    }else if ($action == "get_top_revenue_by_teacher"){
        $view_teacher_quantity = $data['view_teacher_quantity'];
        call_user_func(array($ctrl,$action),$start_date,$end_date,$view_teacher_quantity);
    }else if ($action == "get_top_seller_by_course"){
        $view_top_course_quantity = $data['view_top_course_quantity'];
        call_user_func(array($ctrl,$action),$start_date,$end_date,$view_top_course_quantity);
    }else
        call_user_func(array($ctrl,$action),$start_date,$end_date);
}else{
    echo "Không tìm thấy";
}