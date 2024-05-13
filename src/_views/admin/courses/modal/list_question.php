<?
global $excerciseId;
global $questions;
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" id="parent-div" data-plugin="dragula" data-containers="[&quot;section-list&quot;]">
                    <div class="col-md-12">
                        <div class="bg-dragula p-2 p-lg-4">
                            <h5 class="mt-0">Danh sách câu hỏi <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=question_modal&excerciseId=<? echo $excerciseId ?>', 'Thêm câu hỏi')" name="button" data-bs-dismiss="modal">Thêm câu hỏi</button> <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="section-sort-btn" onclick="sort()" name="button">Sắp xếp</button>
                            </h5>
                            <div id="section-list" class="py-2">
                                <? if ($questions != null) : ?>
                                    <? foreach ($questions as $key => $question) : ?>
                                        <div class="card mb-0 mt-2 draggable-item" data-id="<? echo $question->ID?>" style="flex-direction: row;">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="mb-1 mt-0"><? echo $question->Content ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-widget d-flex pe-3">
                                                <a class="d-flex align-items-center mr-1" style="text-decoration:none;" data-bs-dismiss="modal" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=question_modal&editmode=1&excerciseId=<?echo $excerciseId?>&questionId=<? echo $question->ID?> ','Sửa nội dung câu hỏi')">
                                                    <i class="mdi-b pen"></i>
                                                </a>
                                                <a class="d-flex align-items-center" style="text-decoration:none;" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_question&questionId=<?echo $question->ID?>','Xóa câu hỏi','Bạn có chắc muốn xóa câu hỏi này')">
                                                    <i class="mdi-b close"></i>
                                                </a>
                                            </div>

                                        </div>

                                    <? endforeach ?>
                                <? endif ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
    Init dragula js
-->
<script>
    ! function(r) {
        "use strict";
        var a = function() {
            this.$body = r("body")
        };
        a.prototype.init = function() {
            r('[data-plugin="dragula"]').each(function() {
                var a = r(this).data("containers"),
                    t = [];
                if (a)
                    for (var n = 0; n < a.length; n++) t.push(r("#" + a[n])[0]);
                else t = [r(this)[0]];
                var i = r(this).data("handleclass");
                i ? dragula(t, {
                    moves: function(a, t, n) {
                        return n.classList.contains(i)
                    }
                }) : dragula(t)
            })
        }, r.Dragula = new a, r.Dragula.Constructor = a
    }(window.jQuery),
    function(a) {
        "use strict";
        window.jQuery.Dragula.init()
    }();
</script>
<script>
    function sort() {
        var containerArray = ['section-list'];
        var itemArray = [];
        $('#section-list .draggable-item').each(function() {
            var id = $(this).data('id')
            itemArray.push(id)
        })
        console.log(itemArray);
        $.ajax({
            type: 'POST',
            url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=sort_question',
            contentType: 'application/json',
            data: JSON.stringify(itemArray),
            success: function(response) {
                toastr.success("Sắp xếp lại thành công", "Thông báo : ")
            }
        });
    }
</script>