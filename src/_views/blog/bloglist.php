<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class BlogListPage extends BaseHTMLDocumentPage
{
    public $posts;
    public $authors;
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
        parent::documentInfo($author, $description, "Blog - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Blog - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->style(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
            "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        );
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "/clients/css/home/home_main.css",
            "/clients/css/header/header.css",
            "/clients/css/footer/footer.css",
            "/clients/css/blog/bloglist.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="container-fluid py-5 my-5">
            <div class="container py-5 my-5" >
                <!-- Pagination -->
                <div class="col-12">
                    <nav aria-label="Page navigation" style="all:unset">
                        <ul class="pagination pagination-lg justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- End Pagination -->
                <div class="row">
                    <!-- Blog list -->
                    <div class="col-lg-8">
                        <!-- Search Form -->
                        <div class="row pb-5 d-flex search-form my-5">
                            <div class="col-lg-8 d-flex justify-content-between w-100">
                                <h3 class="title-h3 my-5" >All Articles</h3>
                                <form action="" class="mb-0 " >
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg input-search" placeholder="Search here">
                                        <div class="input-group-append">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Search -->
                        <!-- Blog items -->
                        <div class="col pb-3 margin-y-3">
                            <div class="row-md-6 mb-4">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <img class="img-fluid img-blog mb-3 mb-md-0"  src="/assets/images/blog.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="blog-item position-relative overflow-hidden rounded mb-2" style="min-height: 100%;">
                                            <a class="blog-overlay text-decoration-none" href="/blog/detail.php">
                                                <h4 class="text-border mb-2">Best LearnPress WordPress Theme Collection For 2024</h4>
                                                <div class="date-group">
                                                    <i class="fas fa-calendar-days"></i>
                                                    <p class="">Jan 01, 2024</p>
                                                </div>
                                                <span class="text-muted">Looking for a amazing & well-functional LearnPress WordPress Theme? Online education...</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Blog items -->

                        <!-- Pagination -->
<!--
                        <div class="col-12">
                            <nav aria-label="Page navigation" style="all:unset">
                                <ul class="pagination pagination-lg justify-content-center mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
-->
                        <!-- End Pagination -->
                    </div>
                    <!-- End Blog list -->

                    <!-- Category list etc... -->
                    <div class="col-lg-4 pl-3">
                        <!-- Category List -->
                        <div class=" category-list">
                            <h3 class="title-h3 margin-y-3" >Categories</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5  " >
                                    <a href="" class="text-decoration-none h4 m-0">Commerical</a>
                                    <span>15</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5" >
                                    <a href="" class="text-decoration-none h4 m-0">Office</a>
                                    <span>15</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5" >
                                    <a href="" class="text-decoration-none h4 m-0">Shop</a>
                                    <span>15</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5" >
                                    <a href="" class="text-decoration-none h4 m-0">Educate</a>
                                    <span>15</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5" >
                                    <a href="" class="text-decoration-none h4 m-0">Academy</a>
                                    <span>15</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border px-5" >
                                    <a href="" class="text-decoration-none h4 m-0">Single family home</a>
                                    <span>15</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Recent Post -->
                        <div class="mb-5 recent-post margin-y-3">
                            <h3 class="title-h3 mb-4">Recent Post</h3>
                            <a class="d-flex align-items-center text-decoration-none margin-y-3 border " href="">
                                <img class="img-fluid rounded" src="/assets/images/blog4.png" alt="wordpress image" style="max-width: 50%;">
                                <div class="pl-3 ">
                                    <h4>Best LearnPress WordPress Theme Collection For 2024</h4>
                                </div>
                            </a>
                        </div>

                        <!-- Tag Cloud -->
                        <div class="mb-5 tags">
                            <h3 class="title-h3 mb-4">Tags</h3>
                            <div class="d-flex flex-wrap m-n1">
                                <a href="" class="btn btn-outline-dark m-5 p-5">Development</a>
                                <a href="" class="btn btn-outline-dark m-5 p-5">Design</a>
                                <a href="" class="btn btn-outline-dark m-5 p-5">Marketing</a>
                                <a href="" class="btn btn-outline-dark m-5 p-5">SEO</a>
                                <a href="" class="btn btn-outline-dark m-5 p-5">Writing</a>
                                <a href="" class="btn btn-outline-dark m-5 p-5">Consulting</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Category list etc  -->
                </div>
            </div>
        </div>

        <script>
            let searchIcon = document.querySelector('.fa-search');
            let inputSearch = document.querySelector('.input-search');

            searchIcon.addEventListener('click', () => {
                if (inputSearch.style.display === 'block') {
                    inputSearch.style.display = 'none';
                } else {
                    inputSearch.style.display = 'block';
                    inputSearch.style.width = '150px';
                    inputSearch.style.marginLeft = '-184%';
                    searchIcon.style.width = '1.5rem';
                    searchIcon.style.height = '1.5rem';
                    searchIcon.style.marginRight = '-100px';
                }
            });
        </script>
        <?
    }

    // publi
    function afterDocument(){}
    // {
    //     parent::afterDocument();
    // }
}
?>