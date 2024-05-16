
function autocomplete(inp, inp_save, url, positionAbsolute) {
    // cái input tag
    inp.addEventListener("input", function(e) {
        closeAllLists(inp);
        var val = this.value;
        if (!this.value)
            {return false;}
        currentFocus = -1;
        var data = {
            search_input : val
        };
        //gọi ajax tìm từ
        $.ajax({
            url : url,
            data : data,
            dataType: 'json',
            success : function(response)
            {
                if(response.status == '204')
                {
                    show_autocomplete(inp,val,response.items,inp_save,positionAbsolute);
                }
                else if(response.status == '404')
                {
                    closeAllLists(inp);
                }
            }
        });
    });

    //Xử lí bàn phím
    inp.addEventListener("keydown", function(e) {
        console.log(currentFocus);
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            }
        }
    });

    document.addEventListener("click", function (e) {
        //Xóa nếu target của cú click không phải là thanh tìm kiếm hoặc khung autocomplete
        closeAllLists(inp,e.target);
    });
}
function show_autocomplete(inp,val,data,inp_save,positionAbsolute){   
    
    //Đóng danh sách đang mở nếu có
    var a, b, i;
    a = document.createElement("DIV");
    a.setAttribute("id", inp.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    if(positionAbsolute){
        a.classList.add("posAbsolute");
    }
    // Thêm div vào chung container mẹ với tag input    
    inp.parentNode.appendChild(a);
            
    for (i = 0; i < data.length; i++) {
    // Kiểm tra trùng chữ cái đầu
            // Tạo div item cho mỗi mục trùng với input
            b = document.createElement("DIV");
            // In đậu những kí tự trùng
            b.innerHTML = "<strong>" + data[i]['key'].substr(0, val.length) + "</strong>";
            b.innerHTML += data[i]['key'].substr(val.length);
            // Tạo trường input để chứa giá trị của item 
            b.innerHTML += "<input type='hidden' id='"+ data[i]['ID'] +"' value='" + data[i]['key']+ "'>";
            // Thêm event khi nhấn vào item sẽ in value vào input luôn
            b.addEventListener("click", function(e) {
                inp.value = this.getElementsByTagName("input")[0].value;
                inp_save.value = this.getElementsByTagName("input")[0].id;
                /*Sau khi nhấn thì đóng danh sách*/
                closeAllLists(inp);
            });
        // Thêm item vừa tạo vào div chứa
        a.appendChild(b);
    }  
}

function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
    }
}
function closeAllLists(inp, elmnt) {
    //Xóa các mục autocomplete
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
    }
    }
}