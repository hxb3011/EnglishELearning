<?php
class App {

    private $__controller, $__action, $__params;

    function __construct() {

        global $routes;

        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__controller = $this->__controller ?? 'home';
        $this->__action = 'index';
        $this->__params = [];

        $this->handleURL();
    }

    function getURL() {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    public function handleURL (){
        $url = $this->getURL();
        $urlArr = array_filter(explode('/',$url));
        $urlArr = array_values($urlArr);
        
        // Xử lý controller
        if (!empty($urlArr[0])) {
            $this->__controller = $urlArr[0];
        }
        // Kiểm tra file controller tồn tại không
        if (file_exists('./content/controllers/'.$this->__controller.'/'.$this->__controller.'Controller.php')) {
            require_once './content/controllers/'.$this->__controller.'/'.$this->__controller.'Controller.php';
            // Kiểm tra và khởi tạo class Controller
            if (class_exists($this->__controller.'Controller')){
                $controller_name = $this->__controller.'Controller';
                $this->__controller =new $controller_name;
                unset($urlArr[0]);
            }else{
                echo "Lỗi không tìm thấy controller";
                $this->loadErrors();
            }
        } else {
            $this->loadErrors();
        }

        // Xử lý action
        if (!empty($urlArr[1])){
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        // Xử lý params
        $this->__params = $urlArr ? array_values($urlArr) : [];

        //Check method tồn tại để gọi action
        if (method_exists($this->__controller, $this->__action)){
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadErrors();
        }
    }

    public function loadErrors($errorName='404') {
        require_once './content/views/error'.$errorName.'.php';
    }
}