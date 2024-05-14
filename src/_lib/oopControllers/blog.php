<?php 
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/PostModel.php');
requirm('/dao/CommentModel.php');

requirm('/access/Post.php');
requirm('/access/Comment.php');

class Blog {
    public PostModel $postModel;
    public CommentModel $commentModel;
    public function __construct() {
    }
    public function all()
    {
        requirv("blog/bloglist.php");
        global $page;
        $page = new BlogListPage();
        $page->posts = $this->postModel->getAllPosts();
        $page->authors = ProfileDAO::getAllProfiles();
        requira("_layout.php");
    }
    public function detail(){
        requirv("blog/blogdetail.php");
        global $page;
        $page = new BlogDetailPage();
        $page->author = ProfileDAO::getAllProfiles(0);
        $page->post = $this->postModel->getPostByID("Sub1");
        requirv("components/header.php");
        requira("_layout.php");
    }
}