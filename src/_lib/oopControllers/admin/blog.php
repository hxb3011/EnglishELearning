<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/PostModel.php');
requirm('/dao/CommentModel.php');
requirm('/dao/profile/profile.php');

requirm('/access/Post.php');
requirm('/access/Comment.php');

requirl('/services/s3Service.php');

Class AdminBlog{
    public PostModel $postModel;
    public CommentModel $commentModel;


    public s3Service $s3Service;

    public function __construct(){
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
        $this->s3Service = new s3Service();
    }
// Gọi view
    public function index(){
        requirv("admin/blog/posts/ManageAllPosts.php");
        global $page;
        $page = new ManageAllPosts();
        $page->posts = array_slice($this->postModel->getAllPosts(),0,5);
        $page->authors = ProfileDAO::getProfileByType(0);
        requira("_adminLayout.php");
    }
    public function add(){
        requirv("admin/blog/posts/AddNewPost.php");
        global $page;
        $page = new AddNewPost();
        requira("_adminLayout.php");
    }
    public function edit($profileId)
    {
        requirv("admin/blog/posts/EditPost.php");
        global $page;
        $page = new EditPost();
        $page->post = $this->postModel->getPostsByAuthorID($profileId);
        $page->programs = array();
        $page->basePath = $this->s3Service->getBasePath();
        usort($page->programs, array('AdminCourses', 'compareOrderN'));
        requira("_adminLayout.php");
    }
    /* Thao tác bài đăng */
    public function add_post()
    {
        try {
            $post = new Post();
            $post->ProfileId = $_POST['author'];
            $post->SubId = $this->postModel->generateValidPostID();
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->date  = date("d-m-Y");
            $post->tags = $_POST['tags'];
            $post->status = $_POST['status'];
            $post->updated = $_POST['updated'];

            // lưu file vào folder upload của dự án 
            $post->image = $this->saveImageToFolder($post->SubId);
            $result = $this->postModel->addPost($post);
            if ($result >= 1) {
                header('Location: /administration/blog/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function edit_post()
    {
        try {
            $post = $this->postModel->getPostByID($_REQUEST['ProfileID'], $_REQUEST['SubID']);
            $post->ProfileId = $_POST['ProfileId'];
            $post->SubId = $_POST['SubId'];
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->date  = DateTime::createFromFormat('d-m-Y\TH:i', $_POST['date']);
            $post->tags = $_POST['tags'];
            $post->status = $_POST['status'];
            $post->updated = $_POST['updated'];

            // lưu file vào folder upload của dự án 
            $result = $this->postModel->addPost($post);
            if ($result >= 1) {
                header('Location: /administration/blog/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function delete_post()
    {
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['ProfileID' . 'SubID'])) {
            $result = $this->commentModel->deleteCommentsOfAPost($_REQUEST['ProfileID'], $_REQUEST['SubID']);
            $result = $this->postModel->deletePost($_REQUEST['ProfileID'], $_REQUEST['SubID']);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }

    /* Thao tác bình luận */
    public function add_comment(){
        try {
            $comment = new Comment();
            $comment->PProfId = $_POST['pAuthor'];
            $comment->PSubId = $_POST['psubId'];
            $comment->SubId = $this->commentModel->generateValidCommentID();
            $comment->AuthID = $_POST['author'];
            $comment->content = $_POST['content'];
            $comment->date  = date("d-m-Y");
            $comment->status = $_POST['status'];

            // lưu file vào folder upload của dự án 
            $result = $this->commentModel->addComment($comment);
            if ($result >= 1) {
                header('Location: /administration/blog/index.php');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function delete_comment(){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['PProfileID' . 'PSubID' . 'SubId'])) {
            $result = $this->commentModel->deleteComment($_REQUEST['ProfileID'], $_REQUEST['PSubID'], $_REQUEST['SubID']);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }
        /* Xóa toàn bộ comment */
    public function delete_all_comments(){
        $response = array();
        $jsonData = "";
        if (isset($_REQUEST['PProfileID' . 'PSubID'])) {
            $result = $this->commentModel->deleteCommentsOfAPost($_REQUEST['ProfileID'], $_REQUEST['PSubID']);
        }
        if (isset($result) && $result > 0) {
            $response['status'] = '204';
            $response['message'] = 'Xóa thành công';
        } else {
            $response['status'] = '404';
            $response['message'] = 'Không xóa được';
        }

        $jsonData = json_encode($response);
        echo $jsonData;
    }

    /* Khác */
    private function saveImageToFolder($courseID)
    {
        $relativeDir = 'public/' . 'poster/' . $courseID . '/';

        $relativeFilePath = $relativeDir . basename($_FILES['blog_img']["name"]);
        $fileSource = $_FILES['blog_img']["tmp_name"];
        $result = $this->s3Service->uploadFileToBucket($fileSource, $relativeFilePath);
        return $relativeFilePath;
    }
    private function uploadFile($fileSource, $filePath, $isPublic = true)
    {
        $result = $this->s3Service->uploadFileToBucket($fileSource, $filePath, $isPublic);
        return str_replace($this->s3Service->getBasePath(), '', $result['ObjectURL']);
    }
    private function removeFile($filePath)
    {
        $this->s3Service->deleteFileInBucket($filePath);
    }

}