<?
const NAV_BASE_MASK = 0xFF00;
const NAV_DICT = 0x100;
const NAV_DICT_ALL = 0x101;
const NAV_DICT_REVIEW = 0x102;
const NAV_COURSE = 0x200;
const NAV_COURSE_ALL = 0x201;
const NAV_COURSE_MY = 0x202;
const NAV_COURSE_INTRO = 0x203;
const NAV_BLOG = 0x300;
const NAV_PROF = 0x400;

if (!defined("__UTILS__HTML_DOCUMENT__")) {
    define("__UTILS__HTML_DOCUMENT__", 1);

    class BaseHTMLDocumentPage
    {
        public readonly int $activeNav;
        public function __construct(int $activeNav = NAV_COURSE_INTRO)
        {
            $this->activeNav = $activeNav;
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

        public final function style(string $path, string|null $integrity = null, string|null $crossorigin = null)
        {
            if (isset($integrity))
            {
                $path .= "\" integrity=\"" . $integrity . "\" crossorigin=\"";
                if (!isset($crossorigin)) $crossorigin = "anonymous";
                $path .= $crossorigin;
            }
            ?>
            <link rel="stylesheet" href="<?= $path ?>">
            <?
        }

        public final function styles(string ...$paths)
        {
            foreach ($paths as $value) {
                ?>
                <link rel="stylesheet" href="<?= $value ?>">
                <?
            }
        }

        public final function script(string $path, string|null $integrity = null, string|null $crossorigin = null)
        {
            if (isset($integrity))
            {
                $path .= "\" integrity=\"" . $integrity . "\" crossorigin=\"";
                if (!isset($crossorigin)) $crossorigin = "anonymous";
                $path .= $crossorigin;
            }
            ?>
            <script src="<?= $path ?>"></script>
            <?
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

        public function modal()
        {
        }

        public function afterDocument()
        {
        }
    }
}
?>