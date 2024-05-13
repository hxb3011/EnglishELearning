<?
global $editMode;
global $meaning;
global $example;
?>
<div class="mt-3">
    <form method="POST" action="<? if($editMode)  echo ("/administration/dictionary/ajax_call_action.php?action=update_example");
                                else echo ("/administration/dictionary/ajax_call_action.php?action=add_example") ?>" id="document_frm" enctype="multipart/form-data">
        <input id="meaning_ID" type="hidden" value="<? echo $meaning->ID ?>" name="meaning_ID">
        <input id="lemma_ID" type="hidden" value="<? echo $meaning->lemmaID ?>" name="lemma_ID">
        <input id="example_ID" type="hidden" value="<? if ($editMode) echo $example->ID ?>" name="example_ID">
        <div class="mb-3">
            <label for="example_key" class="form-label">Tên ví dụ</label>
            <input type="text" class="form-control" id="example_key" name="example_key" value="<? if ($editMode) echo $example->example  ?>" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="example_explanation" class="form-label">Ví dụ và giải thích</label>
            <input type="text" class="form-control" id="example_explanation" name="example_explanation" value="<? if ($editMode) echo $example->explanation  ?>" aria-describedby="emailHelp">
        </div>
        
        <button type="submit" class="btn btn-primary"><? if ($editMode) echo ('Sửa'); else echo ("Thêm") ?></button>
    </form>
</div>
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
                example_key: {
                    required: true,
                    minlength: 2
                },
                example_explanation: {
                    required: true,
                },
                
            },
            messages: {
                example_key: {
                    required: "Vui lòng nhập tên tài liệu",
                    minlength: "Độ dài của mô tả bài kiểm tối thiểu là 10"
                },
                example_explanation: {
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