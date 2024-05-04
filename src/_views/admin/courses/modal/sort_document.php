<?
global $documents;
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" id="parent-div" data-plugin="dragula" data-containers="[&quot;section-list&quot;]">
                    <div class="col-md-12">
                        <div class="bg-dragula p-2 p-lg-4">
                            <h5 class="mt-0">Danh sách tài liệu <button type="button" class="btn btn-outline-primary btn-sm btn-rounded alignToTitle" id="section-sort-btn" onclick="sort()" name="button">Sắp xếp</button>
                            </h5>
                            <div id="section-list" class="py-2">
                                <? foreach ($documents as $document) : ?>
                                    <div class="card mb-0 mt-2 draggable-item" data-id="<? echo $document->ID ?>">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="mb-1 mt-0"><? echo $document->Description ?></h5>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                <? endforeach ?>
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
                url: 'http://localhost:62280/administration/courses/api/ajax_call_action.php?action=sort_document',
                contentType: 'application/json',
                data: JSON.stringify(itemArray),
                success: function(response) {
                    console.log(response);
                    toastr.success("Sắp xếp lại thành công", "Thông báo : ")
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);

                }
            });
        }
    </script>