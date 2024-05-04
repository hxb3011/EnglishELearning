<?
    global $course;
    global $excercise;
?>

<form action="<?if(!isset($excercise->ID)) echo("/administration/courses/api/ajax_call_action.php?action=add_excercise"); else echo("/administration/courses/api/ajax_call_action.php?action=update_excercise") ?>" method="post" id="excercise_frm">
    <input type="hidden" name="course_id" value="<? echo $course->id ?>">
    <input type="hidden" name="excercise_id" value="<?if(isset($excercise->ID)) echo $excercise->ID ?>">

    <div class="form-group">
        <label for="title">Mô tả</label>
        <input class="form-control" type="text" name="description" value="<?if (isset($excercise->Description)) echo($excercise->Description)  ?>" id="description" >
    </div>
    <div class="mb-3">
        <label for="excercise_state" class="form-label">Trạng thái</label>
        <select class="form-control" id="excercise_state"  name="excercise_state">
            <option value="1" <?if(isset($excercise->State )&&  $excercise->State == 1 ) echo('selected') ?>>Công khai</option>
            <option value="0" <?if( isset($excercise->State ) && $excercise->State == 0 ) echo('selected') ?>>Ẩn</option>
        </select>
    </div>
    <div class="form-group row mb-3">
        <label class="col-md-2 col-form-label" for="deadline">Deadline</label>
        <div class="col-md-10">
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" placeholder="Chọn deadline" value="<? if(isset($excercise->Deadline)) echo ($excercise->Deadline->format('Y-m-d\TH:i')); ?>" >
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-success" type="submit" name="button">Gửi</button>
    </div>
</form>
<script>
    //thêm các validate rule cho form
    $("#excercise_frm").validate({
        ignore: [],
        onkeyup: function(e) {
            $(e).valid()
        },
        onchange: function(e) {},
        errorPlacement: function() {},
        invalidHandler: function() {
            toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Thêm/sửa bài kiểm : ")
        },
        rules: {
            description: {
                required: true,
                minlength: 5
            },
            deadline:{
                required:true,
            }
        },
        messages: {
            description: {
                required: "Vui lòng nhập tên bài kiểm",
                minlength: "Độ dài của mô tả bài kiểm tối thiểu là 10"
            },
            deadline:{
                required : "Vui lòng nhập deadline"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element); // Place error message after the input element
        },
        submitHandler: function(form) {
            form.submit()
        }
    })
</script>