$(document).ready(function () {

    renderChart();
});

function renderChart(){
    new Chart(document.getElementById("line-chart"), {
        type: "line",
        data: {
            labels: [
                "6/2020",
                "7/2020",
                "8/2020",
                "9/2020",
                "10/2020",
                "11/2020",
                "12/2020",
                "1/2021",
                "2/2021",
                "3/2021",
                "4/2021",
                "5/2021",
                "6/2021",
                "7/2021",
                "8/2021",
                "9/2021",
                "10/2021",
                "11/2021",
                "12/2021",
                "1/2022",
                "2/2022",
                "3/2022",
                "4/2022",
            ],
            //   23 lable
            datasets: [
                {
                    data: [
                        100113, 5652126, 11722060, 15167497, 20825409, 28289457,
                        35561043, 41781285, 46135050, 53344731, 55473726,
                        61313076, 66602219, 67605048, 81311794, 81677258,
                        88848522, 86550104, 93015636, 96789927, 107444337,
                        109032842, 114324537,
                    ],
                    label: "Thu Nhập chung",
                    borderColor: "#3e95cd",
                    fill: false,
                },
                {
                    data: [
                        19794, 1411272, 1661854, 2873983, 5723073, 2895034,
                        4191425, 17370639, 8450674, 4470312, 3572130, 12053125,
                        26884533, 16051707, 15962471, 25183283, 7764093,
                        17871851, 23191740, 6667461, 35292257, 45401098,
                        54161493, 54681708,
                    ],
                    label: "Thu nhập hệ thống",
                    borderColor: "#8e5ea2",
                    fill: false,
                },
            ],
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Tổng quan thu nhập",
            },
        },
    });
}


