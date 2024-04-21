<div class="alert alert-info" role="alert">
    Course: <strong>Siêu cấp vô địch</strong>
</div>
<div class="mt-3">
    <form method="">
        <input id="course_id_for_lesson" type="hidden" value="1" name="course_id_for_lesson">
        <div class="mb-3">
            <label for="lesson_desc" class="form-label">Mô tả ngắn</label>
            <input type="text" class="form-control" id="lesson_desc" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="lesson_state" class="form-label">Trạng thái</label>
            <select  class="form-control" id="lesson_state">
                <option value="0">Công khai</option>
                <option value="1">Ẩn</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="lesson_video" class="form-label">Video</label>
            <input type="text">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>