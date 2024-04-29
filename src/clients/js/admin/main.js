const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});
(function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
})();

function showAjaxModal(url, header) {
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#scrollable-modal .modal-body').html('<div style="text-align:center;"><img src="http://localhost/academy/assets/global/bg-pattern-light.svg" /></div>');
    jQuery('#scrollable-modal .modal-title').html('...');
    // LOADING THE AJAX MODAL
    jQuery('#scrollable-modal').modal('show', { backdrop: 'true' });

    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
        url: url,
        method: 'GET',
        headers: {
            'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
        },
        success: function (response) {
            jQuery('#scrollable-modal .modal-body').html(response);
            jQuery('#scrollable-modal .modal-title').html(header);
        }
    });
}
function showLargeModal(url, header) {
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#large-modal .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="http://localhost/academy/assets/global/bg-pattern-light.svg" height = "50px" /></div>');
    jQuery('#large-modal .modal-title').html('...');
    // LOADING THE AJAX MODAL
    jQuery('#large-modal').modal('show', { backdrop: 'true' });

    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
        url: url,
        success: function (response) {
            jQuery('#large-modal .modal-body').html(response);
            jQuery('#large-modal .modal-title').html(header);
        }
    });
}

function initSummerNote(id) {
    return $(id).summernote({
        placeholder: "",
        height: 230,
    })
}
function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function previewImage(file) {
        let thumb = box.querySelector('.js--image-preview'),
            reader = new FileReader();
        reader.onload = function () {
            thumb.style.backgroundImage = 'url(' + reader.result + ')';
        }
        reader.readAsDataURL(file);
        thumb.className += ' js--no-default';
    }
    function getFile(e) {
        let file = e.currentTarget.files[0];
        checkType(file);
    }
    function checkType(file) {
        let imageType = /image.*/;
        if (!file.type.match(imageType)) {
            throw 'Datei ist kein Bild';
        } else if (!file) {
            throw 'File không tồn tại';
        } else {
            previewImage(file);
        }
    }
    return 0;
}

function confirm_delete_modal(url, title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Hủy",
        confirmButtonText: "Xác nhận"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                success : function(data)
                {
                    if (data.status = '204')
                    {
                        toastr.success('Xóa thành công')
                    }else{
                        toastr.error('Xóa thất bại')
                    }
                }
            })
        }
    });
}

