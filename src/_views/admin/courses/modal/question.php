<?
global $excerciseId;
global $question;
global $content;
global $type;
?>
<style>
    .highlight {
        background-color: yellow;
    }
</style>

<form id="question_form">
    <div class="form-group">
        <input type="hidden" name="excerciseId" value="<? echo $excerciseId ?>">
        <input type="hidden" name="questionId" value="<? if (isset($question->ID)) echo $question->ID ?>">

        <label for="content">Nội dung câu hỏi</label>
        <input class="form-control" type="text" name="content" id="content" value="<? if (isset($question->Content)) echo $question->Content ?>">
    </div>
    <div class="mb-3">
        <label for="state" class="form-label">Trạng thái</label>
        <select class="form-control" id="state" name="state">
            <option value="1" <? if (isset($question->State) && $question->State == 1) echo "selected" ?>>Công khai</option>
            <option value="0" <? if (isset($question->State) && $question->State == 0) echo "selected" ?>>Ẩn</option>
        </select>
    </div>
    <div class="form-group">
        <? if (!isset($question->ID)) : ?>
            <p for="">Loại câu hỏi</p>
            <div class="d-flex justify-content-center align-items-center">
                <div class="ms-1">
                    <input type="radio" name="type" value="multi_choice">
                    <label for="">Nhiều lựa chọn</label>
                </div>
                <div class="ms-1">
                    <input type="radio" name="type" value="matching">
                    <label for="">Nối</label>
                </div>
                <div class="ms-1">
                    <input type="radio" name="type" value="completion">
                    <label for="">Điền khuyết</label>
                </div>
            </div>
        <? else : ?>
            <input type="hidden" name="type" value="<? echo $type ?>">
        <? endif ?>

    </div>
    <div id="questions_area">
        <? if (isset($type) && $type == "multi_choice") : ?>
            <? foreach ($content['multiChoice'] as $index => $value) : ?>
                <div class="form-group options">
                    <div class="input-group">
                        <input type="text" class="form-control" name="mul_options[]" id="option_<? echo ($index + 1) ?>" placeholder="Lựa chọn 1" value=<? echo $value->Content ?> required="">
                        <span class="input-group-text">
                            <input type="checkbox" name="correct_answers[]" value="<? echo ($index + 1) ?>" <? if ($value->Correct) echo "checked" ?>>
                        </span>
                    </div>
                </div>
            <? endforeach ?>
        <? endif ?>
        <? if (isset($type) && $type == "matching") : ?>
            <div id="matchingContainer" class="container ">
                <? foreach ($content['qmatching'] as $index => $value) : ?>
                    <div class="matching-row row g-2 mb-1">
                        <div class="col-md-5 col-sm-12 p3">
                            <input type="text" class="form-control col-md-5" name="question[]" value="<? echo $value->Content ?>" placeholder="Câu hỏi" required>
                        </div>
                        <div class="col-md-5 col-sm-10 p3">
                            <input type="text" class="form-control col-md-5" name="answer[]" value="<? echo $content['qmatchingkey'][$value->ID]->Content ?>" placeholder="Câu trả lời" required>
                        </div>
                        <? if ($index > 0) : ?>
                            <div class="col-md-2 col-sm-2 p3">
                                <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeMatchingRow(this)">-</button>
                            </div>
                        <? endif ?>
                    </div>
                <? endforeach ?>
                <button type="button" class="btn btn-outline-primary btn-rounded btn-icon col-md-6 offset-md-3 mt-3" onclick="addMatchingRow()">Thêm Câu Hỏi</button>
            </div>
        <? endif ?>
        <? if (isset($type) && $type == "completion") : ?>
            <textarea name="complete_content" id="complete_content" class="form-group" value="<? echo $content['qcompletion']->Content ?>" onchange="completionChange(this)" style="width:100%;height:100px;"><? echo $content['qcompletion']->Content ?></textarea>
            <textarea name="preview_content" id="preview_content" class="form-group mt-1" style="width:100%;height:100px;" disabled></textarea>

            <div class="col-md-2 col-sm-2 p3">
                <button type="button" class="btn btn-outline-primary btn-rounded btn-icon mt-1" onclick="setHeightAndOffset()">Chọn</button>
            </div>


            <div id="completion_container">
                <? foreach ($content['qcompmask'] as $index => $value) : ?>
                    <div class="completion-row row g-2 mb-1">
                        <div class="col-md-5 col-sm-12 p3">
                            <input type="text" class="form-control col-md-5" name="offsets[]" value="<? echo $value->Offset ?>" placeholder="Offset" class="tmp" required>
                        </div>
                        <div class="col-md-5 col-sm-10 p3">
                            <input type="text" class="form-control col-md-5" name="length[]" value="<? echo ($value->Length) ?>" placeholder="Chiều dài" required>
                        </div>
                        <? if ($index > 0) : ?>
                            <div class="col-md-2 col-sm-2 p3">
                                <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                            </div>
                        <? endif ?>
                    </div>
                <? endforeach ?>
                <div class="completion-row row g-2 mb-1">
                    <div class="col-md-5 col-sm-12 p3">
                        <input type="text" class="form-control col-md-5" name="offsets[]" placeholder="Offset" required>
                    </div>
                    <div class="col-md-5 col-sm-10 p3">
                        <input type="text" class="form-control col-md-5" name="length[]" placeholder="Chiều dài" required>
                    </div>
                    <div class="col-md-2 col-sm-2 p3">
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                    </div>
                </div>
            </div>
        <? endif ?>
    </div>
    <div class="text-center">
        <button class="btn btn-success mt-2" id="submitButton" type="button" name="submit">Gửi</button>
    </div>
</form>
<? if (!isset($question->ID)) : ?>
    <script>
        $(document).ready(() => {
            $("input[name='type']").change(function() {
                let selectedOption = $('input[name="type"]:checked').val()
                let questions_area = $('#questions_area')
                switch (selectedOption) {
                    case 'multi_choice':
                        questions_area.empty();
                        questions_area.html(
                            `
                        <div class="form-group options">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_1" placeholder="Lựa chọn 1" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="1">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_2" placeholder="Lựa chọn 2" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="2">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_3" placeholder="Lựa chọn 3" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="3">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_4" placeholder="Lựa chọn 4" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="4">
                                        </span>
                                </div>
                        </div>
                        `
                        )
                        break;
                    case 'matching':
                        questions_area.empty();
                        questions_area.html(
                            `
                        <div id="matchingContainer" class="container ">
                            <div class="matching-row row g-2 mb-1">
                                <div class= "col-md-5 col-sm-12 p3">
                                    <input type="text" class="form-control col-md-5" name="question[]" placeholder="Câu hỏi" required>
                                </div>
                                <div class="col-md-5 col-sm-10 p3">
                                    <input type="text" class="form-control col-md-5" name="answer[]" placeholder="Câu trả lời" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon col-md-6 offset-md-3 mt-3" onclick="addMatchingRow()">Thêm Câu Hỏi</button>
                        `
                        )
                        break;
                    case 'completion':
                        questions_area.empty();
                        questions_area.html(
                            `
                        <textarea name="complete_content" id="complete_content" class="form-group" onchange="completionChange(this)"  style="width:100%;height:100px;"></textarea>
                        <textarea name="preview_content" id="preview_content" class="form-group mt-1"  style="width:100%;height:100px;" disabled></textarea>

                        <div class="col-md-2 col-sm-2 p3">
                            <button type="button" class="btn btn-outline-primary btn-rounded btn-icon mt-1" onclick="setHeightAndOffset()">Chọn</button>
                        </div>
                        <div id="completion_container">
                            <div class="completion-row row g-2 mb-1">
                                    <div class= "col-md-5 col-sm-12 p3">
                                        <input type="text" class="form-control col-md-5" name="offsets[]" placeholder="Offset"  class="tmp" required>
                                    </div>
                                    <div class="col-md-5 col-sm-10 p3">
                                        <input type="text" class="form-control col-md-5" name="length[]" placeholder="Chiều dài" required>
                                    </div>
                            </div>                        
                        </div>
                        `
                        )
                        break;
                    default:
                        questions_area.empty()

                }
            })
        })
    </script>
<? endif ?>

<script type="text/javascript">
    $('#submitButton').click(function(event) {
        if ($('#question_form').valid()) {
            let editMode = $('#question_form input[name="questionId"]').val() ? true : false;
            let url;
            if (editMode) {
                url = "/administration/courses/api/ajax_call_action.php?action=update_question"
            } else {
                url = "/administration/courses/api/ajax_call_action.php?action=add_question"
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: $('form#question_form').serialize(),
                success: function(response) {
                    console.log(response)
                    toastr.success("Thêm/sửa thành công câu hỏi thành công")
                    $('#scrollable-modal').modal('hide')
                    showLargeModal('http://localhost:62280/administration/courses/show_modal.php?action=list_question_modal&excerciseId=<? echo $excerciseId ?>', 'Câu hỏi');
                }
            });

        }


    });
</script>
<!-- -->
<script>
    function addMatchingRow() {
        const matchingContainer = document.getElementById('matchingContainer');
        const newMatchingRow = document.createElement('div');
        newMatchingRow.classList.add('matching-row');
        newMatchingRow.innerHTML = `
                    <div class="matching-row row g-2 mb-1">
                        <div class= "col-md-5 col-sm-12 p3">
                            <input type="text" class="form-control col-md-5" name="question[]" placeholder="Câu hỏi" required>
                        </div>
                        <div class="col-md-5 col-sm-10 p3">
                            <input type="text" class="form-control col-md-5" name="answer[]" placeholder="Câu trả lời" required>
                        </div>
                        <div class="col-md-2 col-sm-2 p3">
                                    <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeMatchingRow(this)">-</button>
                        </div>
                    </div>
            `;
        matchingContainer.appendChild(newMatchingRow);
    }

    function removeMatchingRow(button) {
        button.parentNode.parentNode.remove();
    }
</script>
<!-- completion -->
<script>
    function validateOffsetLength(offset, len) {
        if (len != 0) {
            let offsets = [];
            $("input[name='offsets[]']").each(function(index, element) {
                if (element.value != '')
                    offsets.push(element.value);
            })
            let length = [];
            $("input[name='length[]']").each(function(index, element) {
                if (element.value != '')

                    length.push(element.value);
            })
            for (let i = 0; i < offsets.length; i++) {
                if ((offset >= offsets[i]) && (offset <= offsets[i] + length[i])) return false;
                if ((offset + len) >= offsets[i] && offset <= offsets[i]) return false;
            }
            return true;
        }
    }

    function completionChange() {
        $('#completion_container').empty();
        $('#completion_container').html(
            `
            <div class="completion-row row g-2 mb-1">
                                    <div class= "col-md-5 col-sm-12 p3">
                                        <input type="text" class="form-control col-md-5" name="offsets[]" placeholder="Offset" required>
                                    </div>
                                    <div class="col-md-5 col-sm-10 p3">
                                        <input type="text" class="form-control col-md-5" name="length[]" placeholder="Chiều dài" required>
                                    </div>
            </div>  
            `
        )
        $('#preview_content').val($('#complete_content').val())
    }

    function addCompletionRow() {
        let lastOffset = $('input[name=\'offsets[]\']:last').val();
        let lastLength = $('input[name=\'length[]\']:last').val();
        if (lastOffset && lastLength) {
            const matchingContainer = document.getElementById('completion_container');
            const newMatchingRow = document.createElement('div');
            newMatchingRow.classList.add('completion-row');
            newMatchingRow.innerHTML = `
                    <div class="completion-row row g-2 mb-1">
                                        <div class= "col-md-5 col-sm-12 p3">
                                            <input type="text" class="form-control col-md-5" name="offsets[]" placeholder="Offset" required>
                                        </div>
                                        <div class="col-md-5 col-sm-10 p3">
                                            <input type="text" class="form-control col-md-5" name="length[]" placeholder="Chiều dài" required>
                                        </div>
                                        <div class="col-md-2 col-sm-2 p3">
                                            <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                                        </div>
                    </div>  
                `;
            matchingContainer.appendChild(newMatchingRow);
        } else {
            toastr.error('Vui lòng chọn giá trị cho mask mới nhất trước khi thêm')
        }
    }

    function removeCompletionRow(element) {
        let container = element.parentNode.parentNode;
        let offsets = container.querySelectorAll("input[name='offsets[]']")
        let lengths = container.querySelectorAll("input[name='length[]']")
        offset = offsets[offsets.length - 1].value
        len = lengths[lengths.length - 1].value;
        previewCompletionContent(offset, len, true)
        element.parentNode.parentNode.remove();
    }

    function setHeightAndOffset() {
        let textArea = document.getElementById('complete_content')
        offset = textArea.selectionStart;
        length = textArea.selectionEnd - offset;
        if (length) {
            if (validateOffsetLength(offset, length)) {
                $("#completion_container input[name=\"offsets[]\"]:last").val(offset);
                $('#completion_container input[name=\'length[]\']:last').val(length);
                previewCompletionContent(offset, length)
                addCompletionRow()
            } else {
                toastr.error('Khoảng bạn chọn bị trùng')
            }
        }
    }



    function previewCompletionContent(offset, length, reverse = false) {
        if (length) {
            if (!reverse) {
                var text = $('#preview_content').val();
                let mask = "";
                for (i = 0; i < length; i++) {
                    mask += ".";
                }
                text = text.substring(0, offset) + mask + text.substring(offset + length)
                $('#preview_content').val(text)
            } else {
                var text = $('#preview_content').val();
                var textCompletion = $('#complete_content').val()
                let tmp = textCompletion.substring(+offset, (+offset) + (+length))
                let after = (+offset) + (+length);
                text = text.substring(0, offset) + tmp + text.substring(after)
                $('#preview_content').val(text)
            }

        }
    }
</script>
<!-- validatie  -->
<script>
    //thêm các validate rule cho form
    $("#question_form").validate({
        ignore: "[disabled]",
        onkeyup: function(e) {
            $(e).valid()
        },
        onchange: function(e) {},
        errorPlacement: function() {},
        invalidHandler: function() {
            toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Thêm/sửa bài giảng : ")
        },
        rules: {
            content: {
                required: true,
            },
            type: {
                required: true,
            }
        },
        messages: {
            content: {
                required: "Vui lòng nhập nội dung câu hỏi",
            },
            type: {
                required: ""
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
<? if (isset($type) && $type == "completion") : ?>
    <script>
        function initPreviewCompletionContent() {
            let offsets = [];
            $("input[name='offsets[]']").each(function(index, element) {
                if (element.value != '')
                    offsets.push(element.value);
            })
            let length = [];
            $("input[name='length[]']").each(function(index, element) {
                if (element.value != '')

                    length.push(element.value);
            })
            var text = $('#complete_content').val();
            let tmp = text;
            for (let i = 0; i < offsets.length; i++) {
                let mask = "";
                for (j = 0; j < length[i]; j++) {
                    mask += ".";
                }
                text = text.substring(0, offsets[i]) + mask + text.substring(+offsets[i] + (+length[i]))
            }
            $('#preview_content').val(text)
        }
        initPreviewCompletionContent()
    </script>
<? endif ?>