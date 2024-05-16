<?

use Google\Service\Analytics\Resource\Data;

require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/learn/Subscription.php');

class SubscriptionModel
{

    public function getSubscriptionByProAndCourse($ProfileID, $CourseID)
    {
        $sqlQuery = "SELECT * FROM subscription WHERE ProfileID = ? AND CourseID= ?";
        $params = array($ProfileID, $CourseID);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $subscription = new Subscription();
                foreach ($result as $index => $value) {
                    $subscription->constructFromArray($value);
                }
                return $subscription;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public function getNumberOfTotalSub()
    {
        $sqlQuery = "SELECT COUNT(*) as total_sub FROM subscription";
        try {
            $result = Database::executeQuery($sqlQuery);
            return intval($result[0]['total_sub']);
        } catch (Exception $e) {
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
        $params = array(
            $sub->ID,
            $sub->AtDateTime->format('d-m-Y H:i:s'),
            $sub->ProfileID,
            $sub->CourseID,
            $sub->Price
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function get_all()
    {
        //$sqlQuery = "SELECT * FROM subscription,profile,course WHERE subscription.ProfileID = profile.ID AND subscription.CourseID = course.ID";
        $sqlQuery = "SELECT subscription.ID,subscription.AtDateTime,subscription.Price,course.Name,profile.LastName,profile.FirstName FROM subscription,profile,course WHERE subscription.ProfileID =profile.ID AND subscription.CourseID = course.ID";
        try {
            $result = Database::executeQuery($sqlQuery);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_revenue_total($startDate, $endDate)
    {
        $sqlQuery = "SELECT SUM(Price) as total_revenue FROM subscription where AtDateTime between ? AND ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate]);
            return $result[0]['total_revenue'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_buyed_course_total($startDate, $endDate)
    {
        $sqlQuery = "SELECT COUNT(*) as total_buyed_course FROM subscription where AtDateTime between ? AND ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate]);
            return $result[0]['total_buyed_course'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_total_account($startDate, $endDate)
    {
        $sqlQuery = "SELECT COUNT(DISTINCT profile.id) as total_account FROM profile join subscription where type = 1 AND AtDateTime between ? AND ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate]);
            return $result[0]['total_account'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_details_revenue_by_date($startDate, $endDate)
    {
        $sqlQuery = "SELECT AtDateTime,SUM(Price) as total_revenue FROM subscription where AtDateTime between ? AND ? GROUP BY AtDateTime";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_top_revenue_by_teacher($startDate, $endDate, $view_teacher_quantity)
    {
        $sqlQuery = "SELECT profile.ID as profile_id, 
                    profile.LastName as last_name,
                    profile.FirstName as first_name,
                    SUM(subscription.Price) as total_revenue,
                    COUNT(subscription.CourseId) as total_course_selled
                    FROM subscription 
                    JOIN course ON subscription.CourseID = course.ID 
                    JOIN profile ON course.ProfileID = profile.ID
                    where type = 0 and AtDateTime between ? AND ? 
                    GROUP BY profile.ID
                    LIMIT ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate, $view_teacher_quantity]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_total_student_by_teachder($startDate, $endDate, $teacherId)
    {
        $sqlQuery = "SELECT COUNT(DISTINCT ProfileID) as total_student FROM subscription where AtDateTime between ? AND ? AND CourseID IN (SELECT ID FROM course WHERE profileID = ?)";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate, $teacherId]);
            return $result[0]['total_student'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_top_seller_by_course($startDate, $endDate, $view_top_course_quantity)
    {
        $sqlQuery = "SELECT course.ID as course_id,
                    course.Name as course_name,
                    profile.ID as profile_id,
                    profile.LastName as last_name,
                    profile.FirstName as first_name,
                    course.Price as price,
                    COUNT(subscription.ID) as total_order,
                    MAX(subscription.AtDateTime) as last_update
                    FROM subscription
                    JOIN course ON subscription.CourseID = course.ID
                    JOIN profile ON course.ProfileID = profile.ID
                    where type = 0 AND AtDateTime between ? AND ?
                    GROUP BY course.ID
                    ORDER BY total_order DESC
                    LIMIT ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate, $view_top_course_quantity]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_last_day_have_revenue($startDate, $endDate)
    {
        $sqlQuery = "SELECT SUM(price) as price, MAX(AtDateTime) as last_day_have_revenue FROM subscription where AtDateTime between ? AND ?";
        try {
            $result = Database::executeQuery($sqlQuery, [$startDate, $endDate]);
            return $result[0]['last_day_have_revenue'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function getTotalStudentOfCourse($CourseID)
    {
        $sqlQuery = "SELECT COUNT(*) as total_student FROM  subscription WHERE CourseID = ?";
        $params = array($CourseID);

        try{
            $result = Database::executeQuery($sqlQuery,$params);
            if($result != null)
            {
                return intval($result[0]['total_student']);
            }
            return 0;
        }catch(Exception $e)
        {
            return 0;
        }
    }
    public function getRegisterCoursesByUser($ProfileID)
    {
        $sqlQuery = "SELECT CourseID from subscription WHERE ProfileID = ? ";
        $params = array($ProfileID);
        try{
            $result = Database::executeQuery($sqlQuery,$params);
            if($result != null)
            {   
                $courseIDs = array();
                foreach($result as $key=>$value)
                {
                    $courseIDs[] = $value['CourseID'];
                }
                return $courseIDs;
            }else{
                return array();
            }
        }catch(Exception $e)
        {
            return array();
        }
    }
}
