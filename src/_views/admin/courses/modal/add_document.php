<div class="alert alert-info" role="alert">
    Khóa học: <strong>Siêu cấp vô địch</strong>
</div>
<div class="alert alert-info" role="alert">
    Tên bài: <strong>Siêu cấp vô địch</strong>
</div>
<div class="mt-3">
    <form method="">
        <input id="course_id_for_lesson" type="hidden" value="1" name="course_id_for_lesson">
        <div class="mb-3">
            <label for="lesson_desc" class="form-label">Tên bài</label>
            <input type="text" class="form-control" id="lesson_desc" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" value="video" name="document_type" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Video
            </label>
        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="radio" video="word" name="document_type" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault1">
                Word,PDF...
            </label>
        </div>
        <div class="mb-3">
            <label for="lesson_desc" class="form-label">Upload tài liệu</label>
            <input type="file" class="form-control" id="lesson_doc" name="lesson_doc" >
        </div>
        <div class="mb-3">
            <label for="lesson_state" class="form-label">Trạng thái</label>
            <select class="form-control" id="lesson_state">
                <option value="0">Công khai</option>
                <option value="1">Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>