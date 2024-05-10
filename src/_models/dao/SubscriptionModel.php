<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/learn/Subscription.php');

class SubscriptionModel{

    public function getSubscriptionByProAndCourse($ProfileID,$CourseID)
    {
        $sqlQuery = "SELECT * FROM subscription WHERE ProfileID = ? AND CourseID= ?";
        $params=array($ProfileID,$CourseID);
        try{
            $result = Database::executeQuery($sqlQuery,$params);
            if ($result != null) {
                $subscription = new Subscription();
                foreach ($result as $index => $value) {
                    $subscription->constructFromArray($value);
                }
                return $subscription;
            } else {
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}