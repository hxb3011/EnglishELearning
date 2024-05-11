$(document).ready(function() {
    selectPaymentMethod();
});

function selectPaymentMethod() {
    $(document).on('click', '.select-payment-method', async function(e) {
        e.preventDefault();
        $('.select-payment-method').removeClass('select');
        $(this).addClass('select');
        
        const maKH = await getMaKH();
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