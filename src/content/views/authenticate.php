<?php 
    $title = "Đăng nhập - Học tiếng anh Vocala";
    require("./components/header.php") 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../../public/css/login/authenticate.css">
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
                <img src="../../public/images/log.svg" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>Đăng nhập ở đây</p>
                    <button class="btn btn-transaparent" id="sign-in-btn">Sign In</button>
                </div>
                <img src="../../public/images/register.svg" class="image" alt="">
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
    <?php require('./components/footer.php') ?>
</body>
</html>

    