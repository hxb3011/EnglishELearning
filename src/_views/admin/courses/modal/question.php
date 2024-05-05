<?
global $excerciseId;
global $question;
global $content;
?>
<form action="<? if (isset($quesion)) echo "";
                else echo "/administration/courses/api/ajax_call_action.php?action=add_question" ?>" method="post" id="question_form">
    <div class="form-group">
        <input type="hidden" name="excerciseId" value="<? echo $excerciseId ?>">
        <input type="hidden" name="questionId" value="<? if (isset($question->ID)) echo $question->ID ?>">

        <label for="content">Nội dung câu hỏi</label>
        <input class="form-control" type="text" name="content" readonly id="content" value="<? if (isset($question->content)) echo $question->content ?>">
    </div>
    <div class="mb-3">
        <label for="state" class="form-label">Trạng thái</label>
        <select class="form-control" id="state" name="state">
            <option value="1" <? if (isset($question->State) && $question->State == 1) echo "selected" ?>>Công khai</option>
            <option value="0" <? if (isset($question->State) && $question->State == 0) echo "selected" ?>>Ẩn</option>
        </select>
    </div>
    <div class="form-group">
        <p for="">Loại câu hỏi</p>
        <div class="d-flex justify-content-center align-items-center">
            <div class="ms-1">
                <input type="radio" name="type" value="multi_choice" <? if (isset($question->ID)) echo "disabled" ?>>
                <label for="">Nhiều lựa chọn</label>
            </div>
            <div class="ms-1">
                <input type="radio" name="type" value="matching" <? if (isset($question->ID)) echo "disabled" ?>>
                <label for="">Nối</label>
            </div>
            <div class="ms-1">
                <input type="radio" name="type" value="completion" <? if (isset($question->ID)) echo "disabled" ?>>
                <label for="">Điền khuyết</label>
            </div>
        </div>
    </div>
    <div id="questions_area">

    </div>
    <div class="text-center">
        <button class="btn btn-success mt-2" id="submitButton" type="button" name="submit" data-bs-dismiss="modal">Gửi</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(() => {
        $("input[name='type']").change(function() {
            let selectedOption = $('input[name="type"]:checked').val()
            let questions_area = $('#questions_area')
            console.log(selectedOption);
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
                                <div class="col-md-2 col-sm-2 p3">
                                    <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeMatchingRow(this)">-</button>
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
                        <textarea name="complete_content" id="complete_content" class="form-group" onchange="completionChange(this)"  onmouseup="completionMouse(this)"></textarea>
                        <div id="completion_container">
                            <div class="completion-row row g-2 mb-1">
                                    <div class= "col-md-5 col-sm-12 p3">
                                        <input type="text" class="form-control col-md-5" name="completion[]" placeholder="Offset" required>
                                    </div>
                                    <div class="col-md-5 col-sm-10 p3">
                                        <input type="text" class="form-control col-md-5" name="mask[]" placeholder="Chiều dài" required>
                                    </div>
                                    <div class="col-md-2 col-sm-2 p3">
                                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                                    </div>
                            </div>                        
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon col-md-6 offset-md-3 mt-3" onclick="addCompletionRow()">Thêm Câu Hỏi</button>
                        `
                    )
                    break;
                default:
                    questions_area.empty()

            }
        })
    })



    $('#submitButton').click(function(event) {
        // $.ajax({
        //     url: 'http://localhost/academy/admin/quiz_questions/2/add',
        //     type: 'post',
        //     data: $('form#mcq_form').serialize(),
        //     success: function(response) {
        //         if (response == 1) {
        //             success_notify('Question has been added');
        //         } else {
        //             error_notify('No options can be blank and there has to be atleast one answer');
        //         }
        //     }
        // });
        // showLargeModal('http://localhost/academy/modal/popup/quiz_questions/2', 'Manage quiz questions');
        event.stopPropagation();
        event.preventDefault();
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
    function validateOffsetLength(offset, length) {
        if (offset != 0 && length != 0) {

        }
    }

    function completionChange() {
        $('#completion_container').empty();
        $('#completion_container').html(
            `
            <div class="completion-row row g-2 mb-1">
                                    <div class= "col-md-5 col-sm-12 p3">
                                        <input type="text" class="form-control col-md-5" name="completion[]" placeholder="Offset" required>
                                    </div>
                                    <div class="col-md-5 col-sm-10 p3">
                                        <input type="text" class="form-control col-md-5" name="mask[]" placeholder="Chiều dài" required>
                                    </div>
                                    <div class="col-md-2 col-sm-2 p3">
                                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                                    </div>
            </div>  
            `
        )
    }

    function addCompletionRow() {
        const matchingContainer = document.getElementById('completion_container');
        const newMatchingRow = document.createElement('div');
        newMatchingRow.classList.add('completion-row');
        newMatchingRow.innerHTML = `
                <div class="completion-row row g-2 mb-1">
                                    <div class= "col-md-5 col-sm-12 p3">
                                        <input type="text" class="form-control col-md-5" name="completion[]" placeholder="Offset" required>
                                    </div>
                                    <div class="col-md-5 col-sm-10 p3">
                                        <input type="text" class="form-control col-md-5" name="mask[]" placeholder="Chiều dài" required>
                                    </div>
                                    <div class="col-md-2 col-sm-2 p3">
                                        <button type="button" class="btn btn-outline-primary btn-rounded btn-icon" onclick="removeCompletionRow(this)">-</button>
                                    </div>
                </div>  
            `;
        matchingContainer.appendChild(newMatchingRow);
    }

    function removeCompletionRow(element) {

    }

    function completionMouse(textarea) {
        // Lấy vị trí bắt đầu của văn bản được tô chọn
        var startPos = textarea.selectionStart;

        // Lấy vị trí kết thúc của văn bản được tô chọn
        var endPos = textarea.selectionEnd;

        // Tính độ dài của văn bản được tô chọn
        var length = endPos - startPos;

        // Hiển thị thông tin về offset và độ dài
        console.log("Offset: " + startPos + ", Length: " + length);
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
        },
        messages: {
            content: {
                required: "Vui lòng nhập nội dung câu hỏi",
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