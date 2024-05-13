<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/PostModel.php');
requirm('/dao/CommentModel.php');

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
        requirv("admin/blog/ManageAllPosts.php");
        global $page;
        $page = new ManageAllPosts();
        $page->posts = $this->postModel->getAllPosts();

    }
    public function add(){
        requirv("admin/courses/AddNewCoursePage.php");
        global $page;
        $page = new AddNewPost();
        requira("_adminLayout.php");
    }
    public function edit($profileId)
    {
        requirv("admin/courses/EditCoursePage.php");
        global $page;
        $page = new EditPost();
        $page->post = $this->postModel->getPostsByAuthorID($profileId);
        $page->programs = array();
        $page->basePath = $this->s3Service->getBasePath();
        usort($page->programs, array('AdminCourses', 'compareOrderN'));
        requira("_adminLayout.php");
    }
    public function add_post()
    {

        try {
            $post = new Post();
            $post->ProfileId = $_POST['author'];
            $post->SubId = $this->postModel->generateValidPostID();
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
    public function edit_post()
    {
        try {
            $post = $this->postModel->getPostByID($_REQUEST['SubID']);
            $post->ProfileId = $_POST['author'];
            $post->SubId = $this->postModel->generateValidPostID();
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
}