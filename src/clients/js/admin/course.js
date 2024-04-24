$(document).ready(function(){
    $('#form_add_course').validate({
        onfocusout: false,
		onkeyup: false,
		onclick: false,
        rules:{
            title : {
                required : true,
                minlength : 5
            },
            description : {
                required : true,
            },
            start_date:{
                required: true,
                date: true
            },
            end_date:{
                required: true,
                date: true
            },
            tutor:{
                required : true
            },
            course_poster:{
                required:true
            },
            price :{
                required : true
            }
        },
        messages:{
            title : {
                required : "Vui lòng nhập tên khóa học",
                minlength : "Độ dài của tên khóa học tối thiểu là 5"
            },
            description : {
                required : "Vui lòng nhập mô tả khóa học",
            },
            start_date:{
                required: "Vui lòng chọn ngày bắt đầu",
                date: "Hehe"
            },
            end_date:{
                required: "Vui lòng chọn ngày kết thúc",
                date: "kk"
            },
            tutor:{
                required : "Vui lòng chọn giáo viên"
            },
            course_poster:{
                required:"Vui lòng chọn poster cho khóa học"
            },
            price:{
                required:"Vui lòng nhập giá cho khóa học"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    
    })
    $('#submit_add_course').click(function(e){
   
        e.preventDefault();
    })
})
