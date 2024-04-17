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
        "/clients/css/layout/base.css",
        "/clients/css/layout/nav.css",
        "/clients/css/layout/nav/drawer.css",
        "/clients/css/layout/nav/item-icon.css"
    );
    $page->scripts(
        "/clients/utils/general.js",
        "/clients/utils/log.js",
        "/clients/theme/dynamicThemeCSSLoader.js"
    );
    $page->head();
    ?>
</head>

<body mdc-theme="light">
    <? if ( !property_exists($page,'hideNav')): ?>
    <nav>
        <a class="mdi-b nav-item -search _action" hint="Tìm kiếm" href="#"></a>
        <a class="mdi-b nav-item -dictionary" hint="Từ điển" href="#"></a>
        <a class="mdi-b nav-item -courses" hint="Khoá học" href="#"></a>
        <a class="mdi-b nav-item -blogs" hint="Bài viết" href="/blog/all.php"></a>
        <a class="mdi-b nav-item -profile" hint="Cá nhân" href="/profile/index.php"></a>
    </nav>
    <nav class="drawer -dictionary _closed">
        <a class="mdi-b nav-item -back _action" hint="Từ điển" href="#"></a>
        <a class="mdi-b nav-item -dictionary" hint="Tất cả từ" href="#"></a>
        <a class="mdi-b nav-item -dictionary _selected" hint="Ôn từ vựng" href="#"></a>
    </nav>
    <nav class="drawer -courses _closed">
        <a class="mdi-b nav-item -back _action" hint="Khoá học" href="#"></a>
        <a class="mdi-b nav-item -courses" hint="Các khoá học" href="/courses/all.php"></a>
        <a class="mdi-b nav-item -courses" hint="Khoá học của tôi" href="#"></a>
        <a class="mdi-b nav-item -courses _selected" hint="Giới thiệu" href="#"></a>
    </nav>
    <? endif ?>
    <main><? $page->body(); ?></main>
    <scrim></scrim>
</body>
</html>
<? $page->afterDocument(); ?>