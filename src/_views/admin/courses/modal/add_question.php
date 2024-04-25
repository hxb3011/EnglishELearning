<form action="http://localhost/academy/admin/quiz_questions/2/add" method="post" id="mcq_form">
    <div class="form-group">
        <label for="content">Nội dung câu hỏi</label>
        <input class="form-control" type="text" name="content" id="content">
    </div>
    <div class="mb-3">
        <label for="lesson_state" class="form-label">Trạng thái</label>
        <select class="form-control" id="lesson_state">
            <option value="0">Công khai</option>
            <option value="1">Ẩn</option>
        </select>
    </div>
    <div class="form-group">
        <p for="">Loại câu hỏi</p>
        <div class="d-flex justify-content-center align-items-center">
            <div class="ms-1">
                <input type="radio" name="question_type" value="multi_choice">
                <label for="">Nhiều lựa chọn</label>
            </div>
            <div class="ms-1">
                <input type="radio" name="question_type" value="matching">
                <label for="">Nối</label>
            </div>
            <div class="ms-1">
                <input type="radio" name="question_type" value="completion">
                <label for="">Điền khuyết</label>
            </div>
        </div>
    </div>
    <div id="questions_area">

    </div>
    <div class="text-center">
        <button class="btn btn-success mt-2" id="submitButton" type="button" name="button" data-bs-dismiss="modal">Gửi</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(() => {
        $("input[name='question_type']").change(function() {
            let selectedOption = $('input[name="question_type"]:checked').val()
            let questions_area = $('#questions_area')
            switch (selectedOption) {
                case 'multi_choice':
                    questions_area.empty();
                    questions_area.html(
                        `
                        <div class="form-group options">
                            <label>Lựa chọn 1</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_1" placeholder="Lựa chọn 1" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="1">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                            <label>Lựa chọn 2</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_2" placeholder="Lựa chọn 2" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="1">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                            <label>Lựa chọn 3</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_3" placeholder="Lựa chọn 3" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="1">
                                        </span>
                                </div>
                        </div>
                        <div class="form-group options mt-1">
                            <label>Lựa chọn 4</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mul_options[]" id="option_4" placeholder="Lựa chọn 5" required="">
                                        <span class="input-group-text">
                                            <input type="checkbox" name="correct_answers[]" value="1">
                                        </span>
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

    $('#submitButton').click(function(event) {
        $.ajax({
            url: 'http://localhost/academy/admin/quiz_questions/2/add',
            type: 'post',
            data: $('form#mcq_form').serialize(),
            success: function(response) {
                if (response == 1) {
                    success_notify('Question has been added');
                } else {
                    error_notify('No options can be blank and there has to be atleast one answer');
                }
            }
        });
        showLargeModal('http://localhost/academy/modal/popup/quiz_questions/2', 'Manage quiz questions');
    });
</script>