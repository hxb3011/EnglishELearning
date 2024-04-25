<?
if (!defined("__UTILS__REQUIR__")) {
    define("__UTILS__REQUIR__", 1);

    function requira(string $path)
    {
        echo $path;
        $realpath = exec("realpath \$WS_PATH_BASE/" . $path);
        if (defined("DEBUG_REQUIR")) {
            echo "<br>Backtrace: ";
            debug_print_backtrace();
            echo "Path: ", $path, "<br>",
                "RealPath: ", $realpath, "<br>";
        }
        echo $realpath;
        //require_once $realpath;
    }
    function requirc(string $path)
    {
        requira("_controllers/" . $path);
    }
    function requirl(string $path)
    {
        requira("_lib/" . $path);
    }
    function requirm(string $path)
    {
        requira("_models/" . $path);
    }
    function requirv(string $path)
    {
        requira("_views/" . $path);
    }
}
?>