<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Post.php');
Class PostModel{
    public function checkSubIDExist($id){
        $sqlQuery = "SELECT * FROM course WHERE ID=?";
        $param = array($id);
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            if($result != null) return true;
            else    return false;
        } catch(Exception $e){
            return false;
        }
    }
    public function generateValidPostID()
    {
        $max = $this->getNumberOfTotalPost();
        $max = $max + 1;
        while($this->checkSubIDExist('POST'.$max)){
            $max = $max + 1;
        }
        return 'POST' . $max;
    }
    public function getNumberOfTotalPost()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_posts FROM post";
        try {
            $result = Database::executeQuery($sqlQuery, null);
            return intval($result[0]['total_posts']);
        } catch (Exception $e) {
            return 0;
        }
    }
// Lấy toàn bộ dữ liệu post
    public function getAllPosts($profileId = "")
    {
        $sqlQuery = "SELECT post.* , profile.LastName,profile.FirstName FROM post,profile";
        $param=array($profileId);
        try {
            $result = Database::executeQuery($sqlQuery, $param);
            if ($result != null) {
                $posts = [];
                foreach ($result as $index => $value) {
                    $post = new Post();
                    $post->constructFromArray($value);

                    $posts[] = $post;
                }
                return $posts;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
// Lọc post theo người đăng
    public function getPostsByAuthorID(string $profileId){
        $sqlQuery = "SELECT * FROM post WHERE ProfileID=?";
        $param = array($profileId);
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        }
        catch(Exception $e){ 
            echo "ERROR! . $e";
            return false;
        }
    }
    // Lọc chính xác bài post
    public function getPostByID(string $subId){
        $sqlQuery = "SELECT post.*, profile.LastName,profile.FirstName FROM post,profile WHERE  post.ProfileID = profile.ID AND post.SubID =?";
        $params = array($subId);
        try {
            $result = Database::executeQuery($sqlQuery, $params);
            if ($result != null) {
                $post = new Post();
                foreach ($result as $index => $value) {
                    $post->constructFromArray($value);
                }
                return $post;
            } else {
                return null;
            }
        }
        catch(Exception $e){ 
            echo "ERROR! . $e";
            return false;
        }
    }
// Thêm bài post
    public function addPost(Post $post ){
        $sqlQuery = "INSERT INTO post(ProfileId, SubId, Title, Content, Date, Tags, Status, Updated) VALUE(?,?,?,?,?,?,?,?)";
        $param = array(
            "ProfileId" => $post->ProfileId,
            "SubId" => $post->SubId,
            "Title" => $post->title,
            "Content" => $post->content,
            "Date" => $post->date,
            "Tags" => $post->tags,
            "Status" => $post->status,
            "Updated" => $post->updated,
        );
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        }
        catch(Exception $e){
            echo "ERROR! . $e";
            return false;
        }
    }
    public function updatePost(string $new_title, string $new_content, string $tags, int $status, string $profileId, string $subId)
    {
        $current_Date = date('d-m-Y');
        $sqlQuery = "UPDATE post 
                    SET Title=?, Content=?, Date=?, Tags=?, Status=?, Updated=?
                    WHERE SubID=? AND ProfileID=?";
        $params = array(
            $new_title,
            $new_content,
            $current_Date,
            $tags,
            $status,
            true,
            $subId,
            $profileId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            echo "ERROR! . $e";
            return 0;
        }
    }
    public function deletePost(string $profileId, int $subId)
    {
        $sqlQuery = "DELETE FROM post 
                    WHERE ProfileID=? AND SubID=?";
        $params = array(
            $profileId,
            $subId
        );
        try {
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            echo "ERROR! . $e";
            return 0;
        }
    }

    public function AmountOfCommentsOfAPost(string $profileId, int $subId){
        $sqlQuery = "SELECT COUNT(comment.SubId) FROM comment, post
                    WHERE comment.PProfileID=?, comment.PSubId=?";
        $param = array(
            $profileId,
            $subId
        );
        try{
            $result = Database::executeNonQuery($sqlQuery, $param);
            return $result;
        } catch (Exception $e) {
            echo "ERROR! . $e";
            return 0;
        }
    }
}