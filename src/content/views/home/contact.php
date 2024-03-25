<?php
$title = "Liên hệ - Hệ thống học tiếng anh Vocala";
$activeNav = "contact";
require_once(APP_ROOT.'/content/views/components/header.php');
?>
<link rel="stylesheet" href="/public/css/contact/contact.css">
<div class="container mt-5">
    <div class="direct-section mb-5">
        <div class="d-flex justify-content-space-between">
            <div class="section__container pe-5 me-5 ">
                <div class="section-heading section-heading--lg">
                    Cần liên hệ trực tiếp?
                </div>
                <div class="section-sub section-sub--breakline">
                    <p>Dưới đây là thông tin liên hệ của chúng tôi, bạn có thể chọn điện thoại hoặc email, chúng tôi sẽ sẵn lòng trả lời. Hoặc xem bản đồ để biết vị trí.</p>
                </div>
                <div class="col">
                    <div class="section-wrapper ">
                        <img src="/public/images/icon-phone.png" alt="" class="category-icon">
                        <div>
                            <p class="direct__detail--name">Điện thoại</p>
                            <p class="direct__detail--value">(123) 456 7890</p>
                        </div>
                    </div>
                    <div class="section-wrapper">
                        <img src="/public/images/mail.png" alt="" class="category-icon">
                        <div>
                            <p class="direct__detail--name">Email</p>
                            <p class="direct__detail--value">contact@elearning.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__container__map ps-5 ms-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6696584619644!2d106.67968337570312!3d10.759922359496532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b7c3ed289%3A0xa06651894598e488!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBTw6BpIEfDsm4!5e0!3m2!1svi!2s!4v1709744047959!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <div class="contact-section mb-5">
        <div class=" justify-content-space-between">
            <div class="section__container mb-5">
                <div class="section-heading section-heading--lg">
                    Liên hệ với chúng tôi
                </div>
                <div class="section-sub ">
                    <p>Email của bạn sẽ không công khai. Những trường bắt buộc được đánh dấu (*)</p>
                </div>
            </div>
            <div class="section__container__contactform ">
                <form name="contact__form">
                    <div class="d-flex justify-content-between mb-4">
                        <input class="form-control contact__input " placeholder="Name*" name="name" id="contact_input_name">
                        <input class=" form-control contact__input " placeholder="Email*" name="email" id="contact_input_email">
                    </div>
                    <textarea class="form-control contact__textarea" placeholder="Comment" name="comment" id="contact_input_comment"></textarea>
                    <div class="d-flex align-items-center section-sub mt-3">
                        <input type="checkbox" class="contact__checkbox form-check-input mt-0 me-3" name="contact_checkbox">
                        <p class="mb-0">Save my name, email in this brower for the next time I comment</p>
                    </div>
                    <div>
                        <button type="submit" class="contact__button mt-3">Send email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once(APP_ROOT.'/content/views/components/footer.php');
?>
</body>

</html>