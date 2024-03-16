<?php
$title = "E-learning - Tất cả khóa học";
require "../components/header.php";
?>
<link rel="stylesheet" href="../../../public/css/home/home_main.css">
<link rel="stylesheet" href="../../../public/css/courses/all-courses.css">
<link rel="stylesheet" href="../../../public/css/pagination.css">
<div class="wrapper">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Trang chủ</li>
                            <li class="breadcrumb-item " aria-current="page">Khóa học</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 col-sm-12">
                <div class="courses-section__head d-flex justify-content-between align-items-center">
                    <h3 class="courses-section__header">
                        Tất cả khóa học
                    </h3>
                    <div class="courses-section__header__search-wrapper d-flex align-items-center">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <div class="input-group-append">
                                    <button class="btn btn-search" type="button">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="courses-section__content container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="courses-section__content__course-item">
                                <img src="../../../public/images/blog4.png" class="courses-section__content__course-item-image">

                                </img>
                                <div class="courses-section__content__course-item__info d-flex justify-content-between flex-column p-4">
                                    <div>
                                        <div class="course-item__info-section pt-2 pb-4">
                                            <span class="course-item__info-section__author">GV: Nguyễn Thanh Sang</span>
                                        </div>
                                        <p class="course-item__info-section__title">Create an LMS Website with LearnPress</p>
                                        <div class="d-flex align-items-center justify-content-evenly">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="mini-icon">
                                                    <i class="fa-solid fa-clock"></i>
                                                </span>
                                                <span class="course-item__info-section__text">
                                                    2 Tuần
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="mini-icon">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                </span>
                                                <span class="course-item__info-section__text">
                                                    2 Học viên
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="mini-icon">
                                                    <i class="fa-brands fa-dochub"></i>
                                                </span>
                                                <span class="course-item__info-section__text">
                                                    20 Bài học
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between ps-3">
                                        <p class="course-item__info-section__price">3000000 VND</p>

                                        <a href="" class="course-item__info-section__link">Xem chi tiết</a>
                                    </div>
                                </div>
                                <div class="course-item_tag">
                                    Toeic
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination mt-4">
                                <li class="pagination-item">
                                    <!-- <img class="component-2-TEF" src="./assets/component-2-9WX.png" /> -->
                                    <i class="fa-solid fa-chevron-left"></i>
                                </li>
                                <li class=" pagination-item active">
                                    <a href="" class="pagination-item__link">1</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">2</a>
                                </li>
                                <li class="pagination-item">
                                    <a href="" class="pagination-item__link">3</a>
                                </li>
                                <li class="pagination-item">
                                    <!-- <img class="component-2-92X" src="./assets/component-2-fzX.png" /> -->
                                    <i class="fa-solid fa-chevron-right"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="filter-section">
                    <div class="filter-part">
                        <h4 class="filter-part__header">Giảng Viên</h4>
                        <ul class="filter-part__choices">
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Nguyễn Thanh Sang</label>
                            </li>
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Nguyễn Cao Kỳ</label>
                            </li>
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Trần Sơn Hải</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-part">
                        <h4 class="filter-part__header">Giá</h4>
                        <ul class="filter-part__choices">
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Tất cả</label>
                            </li>
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Miễn phí</label>
                            </li>
                            <li class="filter-part__choice">
                                <input type="checkbox">
                                <label for="">Có phí</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../components/footer.php";
?>
</body>

</html>