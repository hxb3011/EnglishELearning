<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/profile.php');
requirm('/dao/CourseModel.php');
requirm('/dao/SubscriptionModel.php');


requirl('/services/S3Service.php');


class Checkout{
    public CourseModel $courseModel;
    public SubscriptionModel $subscriptionModel;
    public S3Service $s3Service;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->subscriptionModel = new SubscriptionModel();
        $this->s3Service = new S3Service();
    }
    public function checkout()
    {
        requirv("checkout.php");
        global $page;
        $page = new CheckoutPage();
        $page->course = $this->courseModel->getCourseById($_SESSION['courseID']);
        $page->profile = ProfileDAO::getProfileByUid($_SESSION['AUTH_UID']);
        requira("_layout.php");
    }
    public function confirm()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $profileID = $data['profileID'];
        $courseID = $data['courseID'];
        $price = intval($data['price']);
        
        $subscription = new Subscription();
        $subscription->ID = $this->subscriptionModel->generateValidID();
        $subscription->ProfileID = $profileID;
        $subscription->CourseID = $courseID;
        $subscription->AtDateTime = new DateTime();

        $this->subscriptionModel->addSubscription($subscription);

        $response = array();
        $response['status'] = 200;
        $response['message'] = "Đăng ký thành công";

        echo json_encode($response);
    }
}