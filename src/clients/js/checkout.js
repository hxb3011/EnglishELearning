$(document).ready(function () {
    selectPaymentMethod();
    handlePayment();
});

var isPaidSuccess = false
var countdownInterval

function selectPaymentMethod() {
    $(document).on('click', '.select-payment-method', async function (e) {
        e.preventDefault();
        $('.select-payment-method').removeClass('select');
        $(this).addClass('select');

        const maKH = "KH001"
        const pay_id = $(this).attr("data-id");

        let payMethodData = sessionStorage.getItem('pttt') ? JSON.parse(sessionStorage.getItem('pttt')) : {};
        if (payMethodData[maKH]) delete payMethodData[maKH];

        payMethodData[maKH] = pay_id;
        sessionStorage.setItem('pttt', JSON.stringify(payMethodData));
    });
}

async function loadCartToCheckout() {
    const maKH = await getMaKH()
    $.ajax({
        url: 'server/src/controller/GioHangController.php',
        method: 'POST',
        data: { action: 'get-all', maKH },
        dataType: 'JSON',
        success: carts => {
            if (carts && carts.length > 0) {
                let html = ''
                carts.forEach((cart) => {
                    html += `
                    <li class="d-flex checkout__right-product" data-id="${cart.ma_course}" >
                        <div class="checkout__right-image">
                            <img src="${course.hinh_anh}" alt="">
                        </div>
                        <div class="checkout__right-info ms-3 align-self-center">
                            <span>${course.name}</span> 
                            <div class="checkout__right-product-price">₫${formatCurrency(cart.gia_sp)}</div>
                        </div>
                    </li>
                `
                })
            }
        },
        error: (xhr, status, error) => console.log(error)
    })
}

function handlePayment() {
    $(document).on('click', '#btn-payment', async function (e) {
        e.preventDefault();

        const profileID = $('#profileID').val();
        const courseID = $('#courseID').val();
        // const ptttData = sessionStorage.getItem('pttt') ? JSON.parse(sessionStorage.getItem('pttt')) : {};
        const today = new Date().toISOString().slice(0, 10);
        const finishTotal = $('#price').val();
        const ptttData = "QR"
        // const pttt_id = await payment(ptttData[profileID])
        if (ptttData === 'QR') {
            soTien = finishTotal
            date = today.replace(/-/g, '')
            noiDungCK = courseID + profileID
            $('.checkout-qrcode-price').text(soTien)
            $('.checkout-qrcode-content').text(noiDungCK)
            handleMethodQRCode(soTien, noiDungCK)
            startCountDown()
        } else {
            console.log(ptttData[profileID] + " KHÔNG tồn tại")
        }
    });
}

let MY_BANK = {
    BANK_ID: "MB",
    ACCOUNT_NO: "0923326749",
    NAME: 'LE TAN MINH TOAN'
}

function handleMethodQRCode(soTien, noiDungCK) {
    let QR = `https://vietqr.me/api/generate/${MY_BANK.BANK_ID}/${MY_BANK.ACCOUNT_NO}/${MY_BANK.NAME}?amount=${soTien}&memo=${noiDungCK}&is_mask=0&bg=7`;
    $('#img-qrcode img').attr('src', QR)
    setTimeout(() => {
        setInterval(() => {
            checkPaid(soTien, noiDungCK)
        }, 3000)
    }, 3000)

    $('.modal-cart.qr-code').addClass('open')
}

async function checkPaid(soTien, noiDungCK) {
    if (isPaidSuccess) {
        return;
    }
    else {
        try {
            const response = await fetch('https://script.google.com/macros/s/AKfycbwbM1K5C-qT12eQ98l_mMHaaCuAoVapdboho9rqS9acaBCPZf3Kq0e5GA62wyCo001L/exec')
            const data = await response.json()
            const lastPaid = data.data[data.data.length - 1]
            lastPrice = +lastPaid["Giá trị"]
            lastContent = lastPaid["Mô tả"]
            console.log(lastPaid);
            const splitArray = lastContent.split(" ");
            //COURSE106640c9a32f39a- lấy đoạn này thay noiDungCK để test
            if (lastPrice >= +soTien && lastContent.includes(noiDungCK)) {
                clearInterval(countdownInterval);
                isPaidSuccess = true
                $('.modal-cart.qr-code').removeClass('open')
                $('.modal-cart.qr-code-success').addClass('open')
                startCountDown2()
                let payTimeOUT = setTimeout(() => {
                    sendPayment()
                }, 6000)
            }
            else {
                console.log("Không thành công")
            }
        }
        catch {
            console.error("checkPaid LỖI")
        }
    }
}

// Xử lý đếm ngược thời gian trong Thanh toán QR CODE
function startCountDown() {
    const countdownElement = document.getElementById('checkout-qrcode-countdown');

    let countdownSeconds = 60; // giây

    countdownInterval = setInterval(() => {
        const minutes = Math.floor(countdownSeconds / 60);
        const seconds = countdownSeconds % 60;

        countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        countdownSeconds--;

        // Kiểm tra khi thời gian đạt 0
        if (countdownSeconds < 0) {
            console.log('hello');
            clearInterval(countdownInterval);
            isPaidSuccess = true
            $('.modal-cart.qr-code').removeClass('open')
        }
    }, 1000);
}

function startCountDown2() {
    const countdownElement = document.getElementById('checkout-qrcode-countdown2');

    let countdownSeconds = 4;

    const countdownInterval2 = setInterval(() => {
        const seconds = countdownSeconds % 60;

        countdownElement.textContent = `${seconds}s`;

        countdownSeconds--;

        if (countdownSeconds < 0) {
            clearInterval(countdownInterval2);
            $('.modal-cart.qr-code-success').removeClass('open');
        }
    }, 1000);
}

function sendPayment() {
    const profileID = $('#profileID').val();
    const courseID = $('#courseID').val();
    const price = +$('#price').val();
    $.ajax({
        url: 'http://localhost:62280/courses/confirm.php',
        type: 'post',
        data: JSON.stringify({ profileID: profileID, courseID: courseID, price: price }),
        success: function (data) {
            let response = JSON.parse(data);
            if (response.status == 200) {
                toastr.success('Đăng ký thành công', 'Thông báo');
                window.location.href = `/courses/learn.php?courseId=${courseID}`;
            }
        }
    })
}
