<?
if (!defined("__UTILS__HTML_DOCUMENT__")) {
    define("__UTILS__HTML_DOCUMENT__", 1);

    class BaseHTMLDocumentPage
    {
        public function __construct()
        {
        }

        public function beforeDocument()
        {
            if (!session_id())
                session_start();
        }

        public function documentInfo(string $author, string $description, string $title)
        {
            ?>
            <meta name="author" content="<?= isset($author) ? $author : "" ?>" />
            <meta name="description" content="<?= isset($description) ? $description : "" ?>" />
            <title><?= isset($title) ? $title : "" ?></title>
            <?
        }

        public function openGraphInfo(string $image, string $description, string $title)
        {
            ?>
            <meta property="og:image" content="<?= isset($image) ? $image : "" ?>" />
            <meta property="og:description" content="<?= isset($description) ? $description : "" ?>" />
            <meta property="og:title" content="<?= isset($title) ? $title : "" ?>" />
            <?
        }

        public function favIcon(string $ico = null, string $svg = null)
        {
            if (isset($ico)) {
                ?>
                <link rel="icon" href="<?= isset($ico) ? $ico : "" ?>" type="image/x-icon">
                <?
            }
            if (isset($svg)) {
                ?>
                <link rel="icon" href="<?= isset($svg) ? $svg : "" ?>" type="image/svg+xml">
                <?
            }
        }

        public final function styles(string ...$paths)
        {
            foreach ($paths as $value) {
                ?>
                <link rel="stylesheet" href="<?= $value ?>">
                <?
            }
        }

        public final function scripts(string ...$paths)
        {
            foreach ($paths as $value) {
                ?>
                <script src="<?= $value ?>"></script>
                <?
            }
        }

        public function head()
        {
        }

        public function body()
        {
        }

        public function afterDocument()
        {
        }
    }
}
?>