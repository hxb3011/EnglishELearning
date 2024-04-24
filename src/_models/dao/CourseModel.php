<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Course.php');
class CourseModel{
    public function getAllCourse()
    {
       $sqlQuery = "SELECT course.* , profile.LastName,profile.FirstName FROM course,profile WHERE course.ProfileID = profile.ID";
        try{
            $result = Database::executeQuery($sqlQuery);
            if ($result != null)
            {
                $courses = [];
                foreach($result as $index=>$value){
                     $course = new Course();
                     $course->constructFromArray($value);

                     $courses[] = $course;
                }
                return $courses;
            }else{
                return null;
            }
        }catch(Exception $e){
            return null;
        }
    }
}