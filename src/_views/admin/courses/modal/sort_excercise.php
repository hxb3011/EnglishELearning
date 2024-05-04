<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" id="parent-div" data-plugin="dragula" data-containers="[&quot;section-list&quot;]">
                    <div class="col-md-12">
                        <div class="bg-dragula p-2 p-lg-4">
                            <h5 class="mt-0">Danh sách câu hỏi <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="section-sort-btn" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_question.php', 'Thêm câu hỏi')" name="button" data-bs-dismiss="modal">Thêm câu hỏi</button> <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="section-sort-btn" onclick="sort()" name="button">Sắp xếp</button>
                            </h5>
                            <div id="section-list" class="py-2">
                                <!-- Item -->
                                <div class="card mb-0 mt-2 draggable-item" id="1">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mb-1 mt-0">Hello</h5>
                                            </div> <!-- end media-body -->
                                        </div> <!-- end media -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end col -->
                                <!-- Item -->
                                <div class="card mb-0 mt-2 draggable-item" id="2">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="mb-1 mt-0">Advanced</h5>
                                            </div> <!-- end media-body -->
                                        </div> <!-- end media -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end col -->
                            </div> <!-- end company-list-1-->
                        </div> <!-- end div.bg-light-->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
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
