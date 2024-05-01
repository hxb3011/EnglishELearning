<?
    global $lesson;
    global $document;
?>
<div class="alert alert-info" role="alert">
    <? if(isset($document->Description)) echo("Tên bài: <strong><? echo($document->Description) ?></strong>"); else echo("Thêm mới")?>
    
</div>
<div class="mt-3">
    <form method="POST" action="<?if(isset($lesson->ID)) echo("/administration/courses/api/ajax_call_action.php?action=add_document"); else echo("/administration/courses/api/ajax_call_action.php?action=update_document")?>"id="document_frm">
        <input id="lessonId" type="hidden" value="<? if (isset($lesson->ID)) echo $lesson->ID ?>" name="lessonId" >
        <input id="documentId" type="hidden" value="<? if (isset($document->ID)) echo $document->ID ?>" name="documentId">
        <div class="mb-3">
            <label for="description" class="form-label">Tên tài liệu</label>
            <input type="text" class="form-control" id="description" name="description" value="<?if(isset($document->Description)) echo $document->Description  ?>" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="flexRadioDefault1">
                Video
            </label>
            <input class="form-check-input" type="radio" value="video" name="type" value="VIDEO"  <?if(isset($document->Type)&& $document->Type=="VIDEO"){ echo('selected'); } ?>id="flexRadioDefault1">
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="flexRadioDefault1">
                Word,PDF...
            </label>
            <input class="form-check-input" type="radio" video="word" name="type" value="TEXT" <?if(isset($document->Type) && $document->Type=="TEXT"){ echo('selected'); } ?> id="flexRadioDefault2">
        </div>
        <div class="mb-3">
            <label for="document_src" class="form-label">Upload tài liệu</label>
            <div class="js-document--preview"></div>
            <input type="file" class="form-control" id="document_src" name="document_src" >
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">Trạng thái</label>
            <select class="form-control" id="state" name="state">
                <option value="1" <?if(isset($document->State)&&  $document->State == 1 ) echo('selected') ?> >Công khai</option>
                <option value="0" <?if(isset($document->State)&&  $document->State == 0 ) echo('selected') ?>>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?if(isset($document->ID)) echo('Sửa'); else echo("Thêm") ?></button>
    </form>
</div>
<? if (!isset($document->ID)) : ?>
<script>
    //thêm các validate rule cho form
    $("#document_frm").validate({
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
                minlength: 10
            },
            type:{
                required:true
            },
            document_src:{
                required:true
            }
        },
        messages: {
            description: {
                required: "Vui lòng nhập tên tài liệu",
                minlength: "Độ dài của mô tả bài kiểm tối thiểu là 10"
            },
            type:{
                required: "Vui lòng chọn loại tài liệu"
            },
            document_src:{
                required: "Vui lòng chọn tài liệu"
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
<? else :?>
    <script>
    //thêm các validate rule cho form
    $("#document_frm").validate({
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
                minlength: 10
            },
            type:{
                required:true
            },
        },
        messages: {
            description: {
                required: "Vui lòng nhập tên tài liệu",
                minlength: "Độ dài của mô tả bài kiểm tối thiểu là 10"
            },
            type:{
                required: "Vui lòng chọn loại tài liệu"
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
<? endif?>