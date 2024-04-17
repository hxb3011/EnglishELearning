<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class AuthenticatePage extends BaseHTMLDocumentPage
{
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
        parent::documentInfo($author, $description, "Đăng nhập - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Đăng nhập - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/clients/css/login/authenticate.css"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="container-authen">
            <div class="forms-container">
                <div class="signin-signup">
                    <!-- Sign in -->
                    <form action="" class="sign-in-form">
                        <h2 class="title">Sign in</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Email or username" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input class="input" type="password" placeholder="Password" required>
                            <i class="fa-solid fa-eye" data-index="0"></i>
                        </div>
                        <a href="/login/forgetpassword" class="btn-link">Forgot password?</a>
                        <input type="submit" value="login" class="btn solid">

                        <p class="social-text">Or Sign in with social platforms</p>
                        <div class="line-seperate"></div>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </form>

                    <!-- Sign-up  -->
                    <form action="" class="sign-up-form">
                        <h2 class="title">Sign up</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Username" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Email">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input class="input" type="password" placeholder="Password" required>
                            <i class="fa-solid fa-eye" data-index="1"></i>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input class="input" type="password" placeholder="Password Again" required>
                            <i class="fa-solid fa-eye" data-index="2"></i>
                        </div>
                        <input type="submit" value="Sign up" class="btn solid">

                        <p class="social-text">Or Sign up with social platforms</p>
                        <div class="line-seperate"></div>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>New here ?</h3>
                        <p>Bạn chưa có tài khoản, hãy đăng ký ở dưới đây</p>
                        <button class="btn btn-transaparent" id="sign-up-btn">Sign Up</button>
                    </div>
                    <img src="/assets/images/log.svg" class="image" alt="">
                </div>

                <div class="panel right-panel">
                    <div class="content">
                        <h3>One of us ?</h3>
                        <p>Đăng nhập ở đây</p>
                        <button class="btn btn-transaparent" id="sign-in-btn">Sign In</button>
                    </div>
                    <img src="/assets/images/register.svg" class="image" alt="">
                </div>
            </div>
        </div>

        <script>
            // Xử lý sliding signin-singup
            let sign_in_btn = document.querySelector("#sign-in-btn");
            let sign_up_btn = document.querySelector("#sign-up-btn");
            let container = document.querySelector(".container-authen");

            sign_up_btn.addEventListener("click", () => {
                container.classList.add("sign-up-mode");
            });

            sign_in_btn.addEventListener("click", () => {
                container.classList.remove("sign-up-mode");
            });

            //Xử lý ẩn/hiện password
            let inputs = document.querySelectorAll(".input");
            let eyeIcons = document.querySelectorAll(".fa-solid.fa-eye");

            eyeIcons.forEach((eyeIcon, index)=> {
                eyeIcon.addEventListener('click',()=>{
                    if (inputs[index].type === "password"){
                        inputs[index].setAttribute('type','text')
                        eyeIcon.classList.remove("fa-eye");
                        eyeIcon.classList.add("fa-eye-slash");
                    } else {
                        inputs[index].setAttribute('type','password');
                        eyeIcon.classList.remove("fa-eye-slash");
                        eyeIcon.classList.add("fa-eye");
                    }
                })
            }) 
        </script>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>