<?
global $course;
global $lesson;
global $editMode;
?>
<div class="alert alert-info" role="alert">
    Khóa học : <strong><? echo $course->name ?></strong>
</div>

<div class="mt-3">
    <form method="post" action="<? if(!$editMode) echo('/administration/courses/api/ajax_call_action.php?action=add_lesson'); else echo('/administration/courses/api/ajax_call_action.php?action=update_lesson'); ?>" id="lesson_frm">
        <input id="course_id" type="hidden" value="<? echo($course->id) ?>" name="course_id">
        <input type="hidden" id="lesson_id" value="<?if($editMode) echo($lesson->ID) ?>" name="lesson_id">
        <div class="mb-3">
            <label for="lesson_desc" class="form-label">Tên bài</label>
            <input type="text" class="form-control" value="<?if($editMode) echo($lesson->Description) ?>" id="lesson_desc" name="lesson_desc" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="lesson_state" class="form-label">Trạng thái</label>
            <select class="form-control" id="lesson_state" value="" name="lesson_state">
                <option value="1" <?if($lesson->State == 1 ) echo('selected') ?>>Công khai</option>
                <option value="0" <?if($lesson->State == 0 ) echo('selected') ?>>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><? if(!$editMode) echo('Thêm'); else echo('Sửa');  ?></button>
    </form>
</div>
<script>
    //thêm các validate rule cho form
    $("#lesson_frm").validate({
        ignore: [],
        onkeyup: function(e) {
            $(e).valid()
        },
        onchange: function(e) {},
        errorPlacement: function() {},
        invalidHandler: function() {
            toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Thêm/sửa bài giảng : ")
        },
        rules: {
            lesson_desc: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            lesson_desc: {
                required: "Vui lòng nhập tên bài giảng",
                minlength: "Độ dài của tên khóa học tối thiểu là 5"
            },
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element); // Place error message after the input element
        },
        submitHandler: function(form) {
            form.submit()
        }
    })
</script>