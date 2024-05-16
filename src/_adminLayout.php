<?
global $page;
if (!isset($page) || !defined("__UTILS__HTML_DOCUMENT__") || !$page instanceof BaseHTMLDocumentPage) {
    require "/var/www/html/_lib/utils/requir.php";
    requirl("utils/htmlDocument.php");
    $page = new BaseHTMLDocumentPage();
}
$page->beforeDocument();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="theme-color" content="#000000" /> -->
    <?
    $page->documentInfo(
        author: "Group xx",
        description: "The MDN Web Docs Learning Area aims to provide" .
            "complete beginners to the Web with all they need to know" .
            "to get started with developing websites and applications.",
        title: "English E-Learning"
    );
    $page->openGraphInfo(
        image: "https://developer.mozilla.org/mdn-social-share.png",
        description: "The Mozilla Developer Network (MDN) provides " .
            "information about Open Web technologies including HTML, " .
            "CSS, and APIs for both websites and HTML Apps.",
        title: "English E-Learning"
    );
    $page->favIcon(svg: "/assets/images/favicon.svg");
    $page->styles(
        "https://fonts.googleapis.com/css?family=Exo%3A600%2C700",
        "https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C700",
        "https://fonts.googleapis.com/css?family=Jost%3A400%2C500",
        "/clients/css/fonts/roboto.css",
        "/clients/css/icons/mdi.x.css",
        "/clients/css/admin/main.css",
    );
    $page->scripts(
        "/clients/utils/general.js",
        "/clients/utils/log.js",
        "/clients/theme/dynamicThemeCSSLoader.js"
    );
    $page->head();
    ?>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="">
            <div class="d-flex justify-content-center" style="padding: 1rem 1rem;">
                <button class="toggle-btn hide-in-lg-md" type="button">
                    <span class="mdi-b -menuIcon"></span>
                </button>
                <div class="sidebar-logo">
                    <a href="/">E-Learning</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/administration/dashboard.php" class="sidebar-link" >
                        <span class="mdi-b -dash"></span>
                        <span class="sidebar-item__text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#courses" aria-expanded="false" aria-controls="courses">
                        <span class="mdi-b -courseIcon"></span>
                        <span class="sidebar-item__text">Khóa học</span>
                    </a>
                    <ul id="courses" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/administration/courses/index.php" class="sidebar-link">Danh sách khóa học</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/administration/courses/add.php" class="sidebar-link">Thêm khóa học</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="/administration/access/account.php" class="sidebar-link" >
                        <span class="mdi-b -account"></span>
                        <span class="sidebar-item__text">Tài khoản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/administration/profile/index.php" class="sidebar-link" >
                        <span class="mdi-b -user"></span>
                        <span class="sidebar-item__text">Hồ sơ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/administration/access/role.php" class="sidebar-link" >
                        <span class="mdi-b -role"></span>
                        <span class="sidebar-item__text">Vai trò</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#dictionary" aria-expanded="false" aria-controls="dictionary" >
                        <span class="mdi-b -dictionary"></span>
                        <span class="sidebar-item__text">Dictionary</span>
                    </a>
                    <ul id="dictionary" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/administration/dictionary/dictionary.php" class="sidebar-link">Quản lý từ điển</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/administration/dictionary/add.php" class="sidebar-link">Thêm từ vựng</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#blog" aria-expanded="false" aria-controls="blog">
                        <span class="mdi-b -blog"></span>
                        <span class="sidebar-item__text">Blog</span>
                    </a>
                    <ul id="blog" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/administration/blog/index.php" class="sidebar-link">Quản lý bài đăng</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Quản lý bình luận</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="/administration/history/index.php" class="sidebar-link" >
                        <span class="mdi-b history"></span>
                        <span class="sidebar-item__text">Lịch sử thanh toán</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="/" class="sidebar-link">
                    <span class="mdi-b back"></span>
                    <span class="sidebar-item__text">Quay lại trang chủ</span>
                </a>
            </div>
        </nav>
        <div class="main">
            <main class="content px-3 py-4">
                <? $page->body() ?>
            </main>
        </div>
    </div>
</body>

</html>
<? $page->afterDocument(); ?>