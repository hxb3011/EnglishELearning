$(document).ready(function() {
    selectPaymentMethod();
    handlePayment();
});

var isPaidSuccess = false
var countdownInterval

function selectPaymentMethod() {
    $(document).on('click', '.select-payment-method', async function(e) {
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
        data: { action: 'get-all' , maKH },
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
    $(document).on('click', '#btn-payment', async function(e) {
        e.preventDefault();

        const maKH = "KH0001"
        // const ptttData = sessionStorage.getItem('pttt') ? JSON.parse(sessionStorage.getItem('pttt')) : {};
        const today = new Date().toISOString().slice(0, 10);
        const finishTotal = "2000"
        const ptttData = "QR"
        //20240510QRCodeKH0001
        
        // const pttt_id = await payment(ptttData[maKH])
        if(ptttData === 'QR') {
            soTien = finishTotal
            // date = today.replace(/-/g, "");
            date = "20240510"
            noiDungCK = date + "QRCode" + maKH
            console.log(noiDungCK)
            $('.checkout-qrcode-price').text(soTien)
            $('.checkout-qrcode-content').text(noiDungCK)
            handleMethodQRCode(soTien, noiDungCK)
            startCountDown()
        } else {
            console.log(ptttData[maKH] + " KHÔNG tồn tại")
        }
    });
}

let MY_BANK = {
    BANK_ID: "MB",
    ACCOUNT_NO: "0778715603",
    NAME: 'DO MINH QUAN'
}

function handleMethodQRCode(soTien, noiDungCK) {
    let QR = `https://vietqr.me/api/generate/${MY_BANK.BANK_ID}/${MY_BANK.ACCOUNT_NO}/${MY_BANK.NAME}?amount=${soTien}&memo=${noiDungCK}&is_mask=0&bg=7`;
    $('#img-qrcode img').attr('src', QR)
    console.log(QR)

    setTimeout(() => {
        setInterval(() => {
            checkPaid(soTien, noiDungCK)
        }, 3000)
    }, 3000)

    $('.modal-cart.qr-code').addClass('open')
}

async function checkPaid(soTien, noiDungCK) {
    if(isPaidSuccess) {
        return;
    }
    else {
        try {
            const response = await fetch('https://script.google.com/macros/s/AKfycbziTf9e_uKRRLrklRBkQ_08OQOAiJmtwJM2G5nS2sAfpIHPgfphpdN810fVbflrLSE/exec')
            const data = await response.json()
            const lastPaid = data.data[data.data.length - 1]
    
            lastPrice = lastPaid["Giá trị"]
            lastContent = lastPaid["Mô tả"]
            
            const splitArray = lastContent.split(" ");
    
            if(lastPrice >= soTien && splitArray[2].includes(noiDungCK)) {
                clearInterval(countdownInterval);
                isPaidSuccess = true
                $('.modal-cart.qr-code').removeClass('open')
                $('.modal-cart.qr-code-success').addClass('open')
                startCountDown2()
                setInterval(() => {
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

async function sendPayment() {
    // const maKH = await getMaKH()
    // const ptttData = sessionStorage.getItem('pttt') ? JSON.parse(sessionStorage.getItem('pttt')) : {};
    // const ttnhData = sessionStorage.getItem('ttnh') ? JSON.parse(sessionStorage.getItem('ttnh')) : {};
    // const today = new Date().toISOString().slice(0, 10);
    // const tmpTotal = $('.checkout-confirm__tmp-total').text().replace(/[₫.]/g, '');
    // const promotion = $('.checkout-confirm__promo').text().replace(/[^0-9]/g, '');
    // const finishTotal = $('.checkout-confirm__money-total').text().replace(/[₫.]/g, '');
    // const note = $('.checkout-note-input').val();
    // const status = 'Chưa xác nhận'

    // const bill = {
    //     'maKH': maKH,
    //     'maTTNH': ttnhData[maKH],
    //     'date': today,
    //     'tmpTotal': tmpTotal,
    //     'promotion': promotion,
    //     'finishTotal': finishTotal,
    //     'payMethod': ptttData[maKH],
    //     'note': note,
    //     'status': status
    // }

    // const resAddBill = await addBill(bill)

    // if (resAddBill.startsWith('HD')) {
    //     if (handleRandomCTSP(resAddBill)) {
    //         alert('Đơn hàng đã được gửi đi, vui lòng chờ nhân viên xác nhận')
    //         clearCart(maKH)
    //         window.location.href = 'index.php?thong-tin-tai-khoan&don-hang';
    //     } 
    //     else {
    //         alert('Đã xảy ra lỗi khi thanh toán, vui lòng thử lại')
    //     }
    // } else {
    //     console.log(resAddBill)
    //     alert('Đã xảy ra lỗi, vui lòng thử lại')
    // }
}
