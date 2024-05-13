<?

use Google\Service\Analytics\Resource\Data;

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
    public function getNumberOfTotalSub()
    {
        $sqlQuery = "SELECT COUNT(*) as total_sub FROM subscription";
        try{
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_sub']);
        }catch(Exception $e)
        {
            return -1;
        }
    }
    public function generateValidID()
    {
        $max = $this->getNumberOfTotalSub();
        $max = $max + 1;
        return 'SUB' . $max;
    }

    public function addSubscription(Subscription $sub)
    {
        $sqlQuery = "INSERT INTO subscription(ID,AtDateTime,ProfileID,CourseID,Price) VALUES(?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),?,?,?)";
        $params= array(
            $sub->ID,
            $sub->AtDateTime->format('d-m-Y H:i:s'),
            $sub->ProfileID,
            $sub->CourseID,
            $sub->Price
        );
        try{
            $result = Database::executeNonQuery($sqlQuery,$params);
            return $result;
        }catch(Exception $e)
        {
            return false;
        }
    }
}