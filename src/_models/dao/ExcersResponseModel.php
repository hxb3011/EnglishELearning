<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/excerciseresponse/ExcersResponse.php');
class ExcersResponseModel
{
    public function getExcersResponseByExcerID($excercsieID)
    {
        $sqlQuery = "SELECT * FROM execsresponse WHERE ExcerciseID = ?";
        $params = array($excercsieID);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $excercise = new ExcersResponse();
                foreach ($result as $index => $value) {
                    $excercise->constructFromArray($value);
                }
                return $excercise;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
}
