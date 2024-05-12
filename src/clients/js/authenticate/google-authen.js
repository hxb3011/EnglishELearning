$(document).ready(function() {
    googleLogin();
});


function googleLogin() {
    $(document).on('click', '.google-login-btn', () => {
        $.ajax({
            url: '/authentication/googleAuthen.php',
            method: 'POST',
            data: JSON.stringify({ action: 'get-google-url' }),
            contentType: 'application/json',
            success: data => {
                // console.log(url);
                // const screenWidth = window.screen.width
                // const screenHeight = window.screen.height
                // const windowWidth = 500
                // const windowHeight = 600
                // const left = (screenWidth - windowWidth) / 2
                // const top = (screenHeight - windowHeight) / 2 - 50
                // window.open(url, 'googleSignInWindow', 'width=' + windowWidth + ', height=' + windowHeight + ', left=' + left + ', top=' + top);
                if (data){
                    window.location.href = data;
                }else {
                    console.log(data);
                }
            },
            error: (xhr, status, error) => console.log(error)
        })
    })
}