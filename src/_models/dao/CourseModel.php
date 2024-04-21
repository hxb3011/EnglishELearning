<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Course.php');
class CourseModel{
    public function getAllCourse()
    {
        
    }
    public function seedDumbData(){
        $course = new Course('1','hello','descreption',1,'USER001',new DateTime(),new DateTime(),100);
        $sqlQuery = "INSERT INTO `course`(ID,Description,PosterUri,State,ProfileID,BeginDate,EndDate,Price) VALUES(?,?,?,?,?,STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),STR_TO_DATE(?,'%d-%m-%Y %H:%i:%s'),?)";
        $formattedBeginDate = $course->beginDate->format('d-m-Y H:i:s');
        $formattedEndDate = $course->endDate->format('d-m-Y H:i:s');

        $params = [
            'ID'=>$course->id,
            'Description'=>$course->description,
            'PosterUri'=>$course->posterURI,
            'State'=>$course->state,
            'ProfileID'=>$course->profileID,
            'BeginDate'=>$formattedBeginDate,
            'EndDate'=>$formattedEndDate,
            'Price'=> $course->price,
        ];
        try{
            Database::executeNonQuery($sqlQuery,$params);
        }catch(Exception $e){

            $e->getMessage();
        }
    }
}