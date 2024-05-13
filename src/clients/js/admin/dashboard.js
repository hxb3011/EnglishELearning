$(document).ready(function () {
    $('#view-teacher-quantity').on('keypress', function (e) {
        e.preventDefault();
    });
    $('#view-top-course-quantity').on('keypress', function (e) {
        e.preventDefault();
    });
    $(document).on('change', '#start-date, #end-date', () => {
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();
        let viewTeacherQuantity = $('#view-teacher-quantity').val();
        let viewCourseQuantity = $('#view-top-course-quantity').val();
        if (startDate !== '' && endDate !== '') {
            getTotalRevenue(startDate, endDate);
            getTotalBuyedCourses(startDate, endDate);
            getTotalAccount(startDate, endDate);
            renderChart(startDate, endDate);
            $('#quantity-number').text(viewTeacherQuantity);
            $('#quantity-course-number').text(viewCourseQuantity);
            renderTopRevenueByTeacher(startDate, endDate, viewTeacherQuantity);
            renderTopSellerCourse(startDate, endDate, viewCourseQuantity);
        }
        // else {
        //     toastr.error("Vui lòng chọn ngày bắt đầu và ngày kết thúc");
        // }
    });
    $('#view-teacher-quantity').on('change', function () {
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();
        let viewTeacherQuantity = $('#view-teacher-quantity').val();
        if (startDate !== '' && endDate !== '' && viewTeacherQuantity !== '') {
            $('#quantity-number').text(viewTeacherQuantity);
            renderTopRevenueByTeacher(startDate, endDate, viewTeacherQuantity);
        }
        // else {
        //     toastr.error("Vui lòng chọn ngày bắt đầu và ngày kết thúc");
        // }
    });
    $('#view-top-course-quantity').on('change', function () {
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();
        let viewCourseQuantity = $('#view-top-course-quantity').val();
        if (startDate !== '' && endDate !== '' && viewCourseQuantity !== '') {
            $('#quantity-course-number').text(viewCourseQuantity);
            renderTopSellerCourse(startDate, endDate, viewCourseQuantity);
        }
        // else {
        //     toastr.error("Vui lòng chọn ngày bắt đầu và ngày kết thúc");
        // }
    });
});

function renderTopSellerCourse(startDate, endDate, viewCourseQuantity) {
    getTopSellerCourse(startDate, endDate, viewCourseQuantity).then((data) => {
        let html = '';
        for (let i = 0; i < data.length; i++) {
            html += `
                <tr style="text-align: center">
                    <td>${data[i]['course_name']}</td>
                    <td>${data[i]['first_name']} ${data[i]['last_name']}</td>
                    <td>${data[i]['price']} $</td>
                    <td>${data[i]['total_order']}</td>
                    <td>${data[i]['last_update']}</td>
                </tr>
            `;
        }
        $('#table-top-course').html(html);
    });
}

function renderTopRevenueByTeacher(startDate, endDate , viewTeacherQuantity) {
    getTopRevenueByTeacher(startDate, endDate, viewTeacherQuantity).then(async (data) => {
        let html = '';
        for (let i = 0; i < data.length; i++) {
            let totalStudent = await getTotalStudentTeachers(startDate, endDate, data[i]['profile_id']);
            html += `
                <tr style="text-align: center">
                    <td>${data[i]['first_name']}  ${data[i]['last_name']}</td>
                    <td>${data[i]['total_course_selled']}</td>
                    <td>${data[i]['total_revenue']} $</td>
                    <td>${totalStudent}</td>
                </tr>
            `;
        }
        $('#table-teacher').html(html);
    });
}

let chart;
async function renderChart(startDate, endDate) {
    if (chart)
        chart.destroy();

    let labels = [];
    let dataPrice = [];
    totalPrices = await getDetailsRevenue(startDate, endDate);
    // console.log(totalPrices);
    let dateRevenue = {};
    for (let i = 0; i < totalPrices.length; i++) {
        let date = new Date(totalPrices[i]['AtDateTime']).toISOString().split('T')[0];
        dateRevenue[date] = totalPrices[i]['total_revenue'];
    }
    for (let i = new Date(startDate); i <= new Date(endDate); i.setDate(i.getDate() + 1)) {
        labels.push(i.toISOString().split('T')[0]);
        dataPrice.push(dateRevenue[i.toISOString().split('T')[0]] || 0);
    }
    // console.log(dataPrice);
    chart = new Chart(document.getElementById("line-chart"), {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    data: dataPrice,
                    label: "Hóa đơn",
                    borderColor: "#3e95cd",
                    fill: false,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
}

function getTotalRevenue(startDate, endDate) {
    $.ajax({
        url: "/administration/dashboard/call_ajax.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            action: "get_revenue_total",
            start_date: startDate,
            end_date: endDate
        }),
        success: function (response) {
            // console.log(JSON.parse(response).data);
            $("#total-revenue").text(JSON.parse(response).data + " $");
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function getTotalBuyedCourses(startDate, endDate) {
    $.ajax({
        url: "/administration/dashboard/call_ajax.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            action: "get_buyed_course_total",
            start_date: startDate,
            end_date: endDate
        }),
        success: function (response) {
            // console.log(JSON.parse(response).data);
            $("#total_buyed_course").text(JSON.parse(response).data + " Khóa học");
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function getTotalAccount(start_date, end_date) {
    $.ajax({
        url: "/administration/dashboard/call_ajax.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            action: "get_total_account",
            start_date: start_date,
            end_date: end_date
        }),
        success: function (response) {
            // console.log(JSON.parse(response).data);
            $("#total_account").text(JSON.parse(response).data + " Tài khoản");
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function getDetailsRevenue(start_date, end_date) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/administration/dashboard/call_ajax.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                action: "get_details_revenue_by_date",
                start_date: start_date,
                end_date: end_date
            }),
            success: function (response) {
                resolve(JSON.parse(response).data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

function getTopRevenueByTeacher(start_date, end_date, viewTeacherQuantity) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/administration/dashboard/call_ajax.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                action: "get_top_revenue_by_teacher",
                start_date: start_date,
                end_date: end_date,
                view_teacher_quantity: viewTeacherQuantity
            }),
            success: function (response) {
                // console.log(response);
                resolve(JSON.parse(response).data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

function getTotalStudentTeachers(start_date, end_date, teacher_id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/administration/dashboard/call_ajax.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                action: "get_total_student_by_teacher",
                start_date: start_date,
                end_date: end_date,
                teacher_id: teacher_id
            }),
            success: function (response) {
                // console.log(response);
                resolve(JSON.parse(response).data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

function getTopSellerCourse(start_date, end_date, view_top_course_quantity) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/administration/dashboard/call_ajax.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                action: "get_top_seller_by_course",
                start_date: start_date,
                end_date: end_date,
                view_top_course_quantity: view_top_course_quantity
            }),
            success: function (response) {
                // console.log(response);
                resolve(JSON.parse(response).data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

// async function CalculatePercentageOfTotalRevenue(start_date, end_date) {
//     let oldRevenue = $('#total-revenue').text().split(" ")[0];
//     let newRevenue = await getLastDayHaveRevenue(start_date, end_date)[0]['total_revenue'];
//     console.log(newRevenue);
//     let percentage = ((newRevenue - oldRevenue) / oldRevenue) * 100;
//     if (percentage < 0) {
//         $('#percentage_revenue').text("Giảm khoảng " + percentage + " %");
//     }else {
//         $('#percentage_revenue').text("Tăng khoảng " + percentage + " %");
//     };
// }

// function getLastDayHaveRevenue(start_date, end_date) {
//     return new Promise((resolve, reject) => {
//         $.ajax({
//             url: "/administration/dashboard/call_ajax.php",
//             type: "POST",
//             contentType: "application/json",
//             data: JSON.stringify({
//                 action: "get_last_day_have_revenue",
//                 start_date: start_date,
//                 end_date: end_date
//             }),
//             success: function (response) {
//                 // console.log(response);
//                 resolve(JSON.parse(response).data);
//             },
//             error: function (error) {
//                 reject(error);
//             },
//         });
//     });
// }