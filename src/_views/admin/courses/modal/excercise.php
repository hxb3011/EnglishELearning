<form action="http://localhost/academy/admin/quizes/1/add" method="post">
    <div class="form-group">
        <label for="title">Mô tả</label>
        <input class="form-control" type="text" name="description" id="description" required="">
    </div>
    <div class="mb-3">
        <label for="lesson_state" class="form-label">Trạng thái</label>
        <select class="form-control" id="lesson_state">
            <option value="0">Công khai</option>
            <option value="1">Ẩn</option>
        </select>
    </div>
    <div class="form-group row mb-3">
        <label class="col-md-2 col-form-label" for="deadline">Deadline</label>
        <div class="col-md-10">
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" placeholder="Chọn deadline">
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-success" type="submit" name="button">Gửi</button>
    </div>
</form>