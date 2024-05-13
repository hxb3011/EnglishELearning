<?
global $lemma;
global $meaning;
global $editMode;
?>
<div class="alert alert-info" role="alert">
    Bổ sung nghĩa cho: <strong><? echo $lemma->keyL ?></strong>
</div>

<div class="mt-3">
    <form method="post" action="<? if(!$editMode) echo('/administration/dictionary/ajax_call_action.php?action=add_meaning'); else echo('/administration/dictionary/ajax_call_action.php?action=update_meaning'); ?>" id="lesson_frm">
        <input id="lemma_ID" type="hidden" value="<? echo($lemma->ID) ?>" name="lemma_ID">
        <input  id="meaning_ID" type="hidden" value="<? if($editMode) echo($meaning->ID) ?>" name="meaning_ID">
        <div class="mb-3">
            <label for="meaning_key" class="form-label">Nghĩa</label>
            <input type="textarea" class="form-control" value="<?if($editMode) echo($meaning->meaning); ?>" id="meaning_key" name="meaning_key" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="meaning_explanation" class="form-label">Giải thích</label>
            <input type="textarea" class="form-control" value="<?if($editMode) echo($meaning->explanation); ?>" id="meaning_explanation" name="meaning_explanation" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="meaning_note" class="form-label">Ghi chú</label>
            <input type="textarea" class="form-control" value="<?if($editMode) echo($meaning->note); ?>" id="meaning_note" name="meaning_note" aria-describedby="emailHelp">
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
            meaning_key: {
                required: true,
                minlength: 2
            },
            meaning_explanation: {
                required: true,
                minlength: 2
            },
            meaning_note: {
            },
        },
        messages: {
            meaning_key: {
                required: "Vui lòng nhập nghĩa",
                minlength: "Vui lòng nhập nghĩa"
            },
            meaning_explanation: {
                required: "Vui lòng nhập giải thích cho nghĩa",
                minlength: "Vui lòng nhập giải thích cho nghĩa"
            },
            meaning_note: {
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