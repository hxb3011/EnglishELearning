<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class BlogDetailPage extends BaseHTMLDocumentPage
{
    public $post;
    public function __construct()
    {
        parent::__construct();
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Blog-Detail - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Blog-Detail - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "/clients/css/blog/blogdetail.css",
            "/clients/css/home/home_main.css",
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
            <div class="wrap_container">
                <!-- Pagination -->
                <div class="container">
                    <div class="pagination_wrapper">
                        <div aria-label="Page navigation" class="pagination_all_blogs">
                            <ul class="pagination pagination-lg">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <p aria-hidden="true">&laquo;</p>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <p aria-hidden="true">&raquo;</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Pagination -->
                    <div class="row">
                        <!-- Blog Detail -->
                        <div class="col-lg-8 blog_detail">
                            <!-- Blog Detail Content -->
                            <div class="row mb-5">
                                <h3 class="text-uppercase mb-2" style="white-space: nowrap; font-weight: 600; font-size: 2.2rem;">Best LearnPress WordPress Theme Collection For 2024</h3>
                                <!-- Begin Author,Date -->
                                <div class="col-lg-12 d-flex">
                                    <div class="mb-3 mr-3">
                                        <i class="fa-solid fa-user" style="color: orange;"></i>
                                        <span class="text-muted">Chấn Phong</span>
                                    </div>
                                    <div class="mb-3 mr-3">
                                        <i class="fa-regular fa-calendar" style="color: orange;"></i>
                                        <span class="text-muted">Jan 24. 2024</span>
                                    </div>
                                    <div class="mb-3 mr-3">
                                        <i class="fa-solid fa-comment" style="color: orange;"></i>
                                        <span class="text-muted">20</span>
                                    </div>
                                </div>
                                <!-- End Author, Date -->

                                <!-- Begin Blog Detail Data -->
                                <div class="col-lg-12 mb-5">
                                    <img class="img-fluid img-blog mb-3 mb-md-0" style="width: 100%; border-radius: 2rem;" src="/assets/images/blog.png" alt="">
                                    <p class="text-muted mt-5">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                    </p>
                                    <p class="text-muted mb-3">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                    </p>
                                </div>
                                <!-- End Blog Detail Data -->

                                <!-- Begin Share -->
                                <div class="col-lg-4" style="font-size: 2.2rem;">
                                    Share:
                                    <i class="fa-brands fa-facebook mr-1"></i>
                                    <i class="fa-brands fa-x-twitter mr-1"></i>
                                    <i class="fa-brands fa-instagram mr-1"></i>
                                </div>
                                <!-- End Share -->

<!-- Pagination tags relative -->
                                <!-- 
                                <div class="row mt-5 tags-relative">
                                    <div class="col prev">
                                        <div class="row prev-row">
                                            <div class="col-md-6 icon-prev">
                                                <a class="page-link d-flex justify-content-center" href="#" aria-label="Previous">
                                                    <i class="fa-solid fa-angle-left"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6 title-prev">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col next">
                                        <div class="row next-row">
                                                <div class="col-md-6 title-next">
                                                </div>
                                                <div class="col-md-6 icon-next">
                                                    <a class="page-link d-flex justify-content-center" href="#" aria-label="Previous">
                                                        <i class="fa-solid fa-angle-right active"></i>
                                                    </a>
                                                </div>    
                                        </div>
                                    </div>
                                </div>
                                 -->
<!-- End Pagination tags ralative -->

                                <!-- Comment -->
                                <div class="comment col-lg-12 mt-5">
                                    <h3 class="text-uppercase mb-4" style="font-weight: 600; font-size: 2.2rem;">Comments</h3>
                                    <h4 class="mb-4" style="font-weight: 300; font-size: 1.8rem">
                                        20 <span>Comments</span>
                                    </h4>
                                    <hr>
                                    <div class="media row mb-4">
                                        <img class="col-md-3 mr-3" src="/assets/images/blog4.png" alt="user image" style="width: 100px;">
                                        <div class="media-body col-md-10">
                                            <div class="row">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="author mt-0">Chấn Phong</h5>
                                                    <p class="date text-muted">Oct 24, 2024</p>
                                                </div>
                                                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                <a href="" class="reply text-decoration-none">
                                                    <i class="fa-solid fa-reply" style="color: orange;"></i>
                                                    Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
<!-- Begin Comment reply -->
<!--
                                    <hr>
                                    <div class="media row mb-4">
                                        <img class="col-md-3 mr-3" src="/assets/images/blog4.png" alt="user image" style="width: 100px;">
                                        <div class="media-body col-md-10">
                                            <div class="row">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="author mt-0">Chấn Phong</h5>
                                                    <p class="date text-muted">Oct 24, 2024</p>
                                                </div>
                                                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                <a href="" class="reply text-decoration-none">
                                                    <i class="fa-solid fa-reply" style="color: orange;"></i>
                                                    Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
-->
<!-- End Comment Reply -->
                                <!-- End Comment -->
                            </div>
                            <!-- End Blog Detail Content -->
<!-- Pagination -->
<!--
                            <div class="col-12 mt-5" id="blogdetail_page_nav">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg  mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <p aria-hidden="true">&laquo;</p>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <p aria-hidden="true">&raquo;</p>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
-->
<!-- End Pagination -->
                            <!-- Leave a comment form -->
                            <div class="col-12 mt-5 form-cmt">
                                <h3 class="text-uppercase mb-4" style="font-weight: 600; font-size: 2.2rem;">Leave a comment</h3>
                                <p class="text-muted">Your email address will not be published. Required fields are marked *</p>
                                <form action="">
                                    <div class="form-row input-author">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" id="inputNameCmt" placeholder="Name*">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" class="form-control" id="inputEmailCmt" placeholder="Email*">
                                        </div>
                                    </div>
                                    <div class="form-group input-area mt-3">
                                        <textarea class="form-control" id="inputComment" rows="5" placeholder="Comment here"></textarea>
                                    </div>
                                    <button type="submit" id="btnCmt" class="btn mt-5">Post Comment</button>
                                </form>
                            </div>
                            <!-- End Leave a comment form -->
                        </div>
                        <!-- End Blog Detail -->

                        <!-- Category list etc... -->
                        <div class="other_content col-lg-4 mt-5">
                            <!-- Category List -->
                            <div class="mb-5 category-list">
                                <h3 class="text-uppercase mb-4" style="font-weight: 600; font-size: 2.2rem;">Categories</h3>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Commerical</a>
                                        <p>15</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Office</a>   
                                        <p>15</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Shop</a>
                                        <p>15</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Educate</a>
                                        <p>15</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Academy</a>
                                        <p>15</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                                        <a href="" class="text-decoration-none h4 m-0">Single family home</a>
                                        <p>15</p>
                                    </li>
                                </ul>
                            </div>
            
                            <!-- Recent Post -->
                            <div class="mb-5 recent-post">
                                <h3 class="text-uppercase mb-4">Recent Post</h3>
                                <a class="d-flex align-items-center text-decoration-none mb-3" href="">
                                    <img class="img-fluid rounded" src="/assets/images/blog4.png" alt="wordpress image" style="max-width: 50%;">
                                    <div class="pl-3">
                                        <h4>Best LearnPress WordPress Theme Collection For 2024</h4>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center text-decoration-none mb-3" href="">
                                    <img class="img-fluid rounded" src="/assets/images/blog4.png" alt="wordpress image" style="max-width: 50%;">
                                    <div class="pl-3">
                                        <h4>Best LearnPress WordPress Theme Collection For 2024</h4>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center text-decoration-none mb-3" href="">
                                    <img class="img-fluid rounded" src="/assets/images/blog4.png" alt="wordpress image" style="max-width: 50%;">
                                    <div class="pl-3">
                                        <h4>Best LearnPress WordPress Theme Collection For 2024</h4>
                                    </div>
                                </a>
                            </div>
            
                            <!-- Tag Cloud -->
                            <div class="mb-5 tags">
                                <h3 class="text-uppercase mb-4; color: orange">Tags</h3>
                                <div class="d-flex flex-wrap m-n1">
                                    <a href="" class="btn btn-outline-dark m-1">Development</a>
                                    <a href="" class="btn btn-outline-dark m-1">Design</a>
                                    <a href="" class="btn btn-outline-dark m-1">Marketing</a>
                                    <a href="" class="btn btn-outline-dark m-1">SEO</a>
                                    <a href="" class="btn btn-outline-dark m-1">Writing</a>
                                    <a href="" class="btn btn-outline-dark m-1">Consulting</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Category list etc  -->
                    </div>
                </div>
            </div>
        <script>
            function getAmountOfComments(){
                
            }
        </script>
        <?
        
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>