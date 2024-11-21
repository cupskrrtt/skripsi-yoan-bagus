//document.addEventListener("DOMContentLoaded", function () {
/*fetch("http://localhost:5000/api/penjualan") // Gantilah URL ini dengan endpoint API Anda
        .then((response) => response.json())
        .then((data) => {
            const tableBody = document.getElementById("sales-table-body");
            const labels = [];
            const chartData = [];
            data.forEach((item, index) => {
                // Tambahkan data ke tabel
                const row = document.createElement("tr");
                row.innerHTML = `
            <td>${index + 1}</td>
            <td>${item.produk}</td>
            <td>${item.jumlah_penjualan}</td>
            <td>${item.status}</td>
          `;
                tableBody.appendChild(row);

                // Tambahkan data ke chart
                labels.push(item.produk); // Menggunakan nama produk sebagai label x
                chartData.push(item.jumlah_penjualan);
            });

            // Inisialisasi grafik batang menggunakan Chart.js
            const ctx = document.getElementById("sales-chart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Jumlah Penjualan",
                            data: chartData,
                            backgroundColor: "rgba(75, 192, 192, 0.6)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Jumlah Penjualan",
                            },
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Produk",
                            },
                        },
                    },
                },
            });
        })
        .catch((error) => console.error("Error:", error));
});*/


// @AR, start
function loadSellingReportView() {
    var sellingReportView = $("#selling-report-table").DataTable({
        ajax: {
            url: "/api/sellingReportView/",
            type: "GET",
            dataSrc: function (json) {
                //console.log(json.sellingReportView);
                return json.sellingReportView;
            },
        },
        columns:[
                    { data: 'product_id' },
                    { data: 'product_name' },
                    { data: 'selling_period' },
                    {
                        data: "selling_total",
                        render: function (data, type, row) {
                            return data
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        },
                    },
                    { data: 'product_availability' },
                ]
    });
}

function loadPurchaseReportView() {
    var purchaseReportView = $("#purchase-report-table").DataTable({
        ajax: {
            url: "/api/purchaseReportView/",
            type: "GET",
            dataSrc: function (json) {
                //console.log(json.purchaseReportView);
                return json.purchaseReportView;
            },
        },
        columns:[
                    { data: 'material_id' },
                    { data: 'material_name' },
                    { data: 'purchase_period' },
                    {
                        data: "purchase_total",
                        render: function (data, type, row) {
                            return data
                                .toString()
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        },
                    },
                    { data: 'material_availability' },
                ]
    });
}

function loadMachineTable() {
    var machineTable = $("#machine-table").DataTable({
        ajax: {
            url: '/api/machine/',
            type: 'GET',
            dataSrc: function (json) {
                //console.log(json.machines);
                return json.machines;
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'machineuse.name' },
            { data: 'machinestatus.name' },

        ]
    });
}

function loadWorkforceTable() {
    var workforceTable = $('#workforce-table').DataTable({
        ajax: {
            url: '/api/workforce/',
            type: 'GET',
            dataSrc: function (json) {
                //console.log(json.workforces);
                return json.workforces;
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'workforceposition.name' },
            { data: 'workforcestatus.name' },
        ]
    });
}

function loadAllTimeSellingReportView() {
    const labels = [];
    const chartData = [];

    $.ajax({
        url: '/api/allTimeSellingReportView/',
        type: 'GET',
        success: function (data) {
            //console.log("API Response:", data); // Log the JSON data

            data.allTimeSellingReportView.forEach((item, index) => {
                // Tambahkan data ke chart
                labels.push(item.product_name); // Menggunakan nama produk sebagai label
                chartData.push(item.selling_total);
            });

            // Tampilkan chart
            finalizeAllTimeSellingChart(labels, chartData);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(
                "There was a problem with the ajax request:",
                textStatus,
                errorThrown
            );
            console.error("Response text:", jqXHR.responseText);
        }
    });
}

// Tampilkan grafik Selling History setelah ambil data
function finalizeAllTimeSellingChart(labels, chartData) {
    const ctx = document.getElementById("sales-chart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Jumlah Penjualan",
                    data: chartData,
                    backgroundColor: "rgba(75, 192, 192, 0.6)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Produk",
                    },
                },
            },
        },
    });
}

function loadProfitReportView() {
    const profitAmount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 12 bulan, masing2 mulai dari 0

    $.ajax({
        url: '/api/profitReportView/',
        type: 'GET',
        success: function (data) {
            //console.log("API Response:", data); // Log the JSON data
            
            data.profitReportView.forEach((item, index) => {
                // ambil bulan dari kolom 'period' (2 digit terakhir) | amount dalam jutaan
                profitAmount[parseInt(item.period.toString().substring(4,6), 10) - 1] += (item.amount / 1000000);
            });

            finalizeProfitChart(profitAmount);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(
                "There was a problem with the ajax request:",
                textStatus,
                errorThrown
            );
            console.error("Response text:", jqXHR.responseText);
        }
    });
}

// Tampilkan grafik Profit setelah ambil data
function finalizeProfitChart(profitAmount) {
    const profitData = {
        labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Mei",
            "Jun",
            "Jul",
            "Agu",
            "Sep",
            "Okt",
            "Nov",
            "Des",
        ],
        datasets: [
            {
                label: "Profit Perusahaan (Jutaan Rupiah)",
                data: profitAmount,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
            },
        ],
    };

    const profitConfig = {
        type: "line", // Anda bisa mengganti dengan 'bar', 'pie', 'doughnut', dll.
        data: profitData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    const ctxProfit = document.getElementById("profitChart").getContext("2d");
    const profitChart = new Chart(ctxProfit, profitConfig);
    
    //console.log(profitData);
}

function loadExpenditureReportView() {
    const expenditureAmount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 12 bulan, masing2 mulai dari 0

    $.ajax({
        url: '/api/expenditureReportView/',
        type: 'GET',
        success: function (data) {
            //console.log("API Response:", data); // Log the JSON data

            data.expenditureReportView.forEach((item, index) => {
                // ambil bulan dari kolom 'period' (2 digit terakhir) | amount dalam jutaan
                expenditureAmount[parseInt(item.purchase_period.toString().substring(4,6), 10) - 1] += (item.amount / 1000000);
            });

            finalizeExpenditureChart(expenditureAmount);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(
                "There was a problem with the ajax request:",
                textStatus,
                errorThrown
            );
            console.error("Response text:", jqXHR.responseText);
        }
    });
}

// Tampilkan grafik Expenditure setelah ambil data
function finalizeExpenditureChart(expenditureAmount) {
    const expenditureData = {
        labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Mei",
            "Jun",
            "Jul",
            "Agu",
            "Sep",
            "Okt",
            "Nov",
            "Des",
        ],
        datasets: [
            {
                label: "Pengeluaran Perusahaan (Jutaan Rupiah)",
                data: expenditureAmount,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1,
            },
        ],
    };
    
    const expenditureConfig = {
        type: "bar", // Anda bisa mengganti dengan 'line', 'pie', 'doughnut', dll.
        data: expenditureData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    const ctxExpenditure = document
    .getElementById("expenditureChart")
    .getContext("2d");
    const expenditureChart = new Chart(ctxExpenditure, expenditureConfig);

    //console.log(expenditureData);
}

// COPAS dari scheduleScript.js
function handleCalendar() {
    $("#calendar").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay",
        },
        defaultDate: "2024-03-14",
        editable: true,
        buttonText: {
            today: "Today",
            month: "Month View",
            week: "Week View",
            day: "Day View",
        },
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: "/api/project/", // Replace with your actual API endpoint
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var events = [];
                    console.log(response); // Log the response to see its structure

                    // Assuming projects are nested under response.projects
                    var projects = response.projects;

                    $.each(projects, function (index, project) {
                        console.log(project); // Log each project to inspect its structure
                        console.log(project.name); // Log project.name to see if it's accessible

                        // Push event data to the events array
                        events.push({
                            title: project.name,
                            start: project.start_date,
                            end: project.end_date,
                        });
                    });
                    callback(events);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data from API: ", error);
                },
            });
        },
        dayClick: function (date) {
            $("#eventStart").val(date.format("YYYY-MM-DD"));
            $("#eventEnd").val(date.format("YYYY-MM-DD"));
            $("#addEventModal").modal("show");
        },
    });
}

// Change calendar month based on dropdown selection
$("#monthSelect").change(function () {
    var selectedMonth = $(this).val();
    var currentYear = new Date().getFullYear();
    var date = new Date(currentYear, selectedMonth, 1);

    $("#calendar").fullCalendar("gotoDate", date);
});

$(document).ready(function() {
    loadSellingReportView();
    loadPurchaseReportView();
    loadMachineTable();
    loadWorkforceTable();

    loadAllTimeSellingReportView();
    loadProfitReportView();
    loadExpenditureReportView();
    
    handleCalendar();
});
// @AR, end
document.addEventListener("DOMContentLoaded", function () {
    // @AR, start
    //const dummyData = [
    //    { produk: "Produk A", jumlah_penjualan: 100, status: "Terjual" },
    //    { produk: "Produk B", jumlah_penjualan: 150, status: "Terjual" },
    //    { produk: "Produk C", jumlah_penjualan: 200, status: "Pending" },
    //    { produk: "Produk D", jumlah_penjualan: 50, status: "Terjual" },
    //    { produk: "Produk E", jumlah_penjualan: 300, status: "Pending" },
    //];
//
    //const tableBody = document.getElementById("sales-table-body");
    //const labels = [];
    //const chartData = [];
    //dummyData.forEach((item, index) => {
    //    // Tambahkan data ke tabel
    //    const row = document.createElement("tr");
    //    row.innerHTML = `
    //    <td>${index + 1}</td>
    //    <td>${item.produk}</td>
    //    <td>${item.jumlah_penjualan}</td>
    //    <td>${item.status}</td>
    //  `;
    //    tableBody.appendChild(row);
//
    //    // Tambahkan data ke chart
    //    labels.push(item.produk); // Menggunakan nama produk sebagai label x
    //    chartData.push(item.jumlah_penjualan);
    //});
    //const labels = [];
    //const chartData = [];

    // Inisialisasi grafik batang menggunakan Chart.js
    //const ctx = document.getElementById("sales-chart").getContext("2d");
    //new Chart(ctx, {
    //    type: "bar",
    //    data: {
    //        labels: labels,
    //        datasets: [
    //            {
    //                label: "Jumlah Penjualan",
    //                data: chartData,
    //                backgroundColor: "rgba(75, 192, 192, 0.6)",
    //                borderColor: "rgba(75, 192, 192, 1)",
    //                borderWidth: 1,
    //            },
    //        ],
    //    },
    //    options: {
    //        scales: {
    //            y: {
    //                beginAtZero: true,
    //                title: {
    //                    display: true,
    //                    text: "",
    //                },
    //            },
    //            x: {
    //                title: {
    //                    display: true,
    //                    text: "Produk",
    //                },
    //            },
    //        },
    //    },
    //});
    // @AR, end
});

// kalau mau nyambungin data base pake yang paling atas

//js buat tabel order
document.addEventListener("DOMContentLoaded", () => {
    function fetchOrders() {
        fetch("fetch_orders.php")
            .then((response) => response.json())
            .then((data) => {
                const tableBody = document.getElementById("order-table-body");
                tableBody.innerHTML = ""; // Clear any existing rows

                data.forEach((order, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${order.nama_pesanan}</td>
                        <td>${order.jumlah_penjualan}</td>
                        <td>${order.status}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch((error) => {
                console.error("Error fetching orders:", error);
            });
    }

    // Fetch orders on page load
    fetchOrders();
});

// Data profit perusahaan (misalnya dalam jutaan rupiah)
// @AR, start
//const profitData = {
//    labels: [
//        "Jan",
//        "Feb",
//        "Mar",
//        "Apr",
//        "Mei",
//        "Jun",
//        "Jul",
//        "Agu",
//        "Sep",
//        "Okt",
//        "Nov",
//        "Des",
//    ],
//    datasets: [
//        {
//            label: "Profit Perusahaan (Jutaan Rupiah)",
//            data: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60], // Data profit contoh
//            backgroundColor: "rgba(75, 192, 192, 0.2)",
//            borderColor: "rgba(75, 192, 192, 1)",
//            borderWidth: 1,
//        },
//    ],
//};
// @AR, end

// Data pengeluaran pabrik (misalnya dalam jutaan rupiah)
// @AR, start
//const expenditureData = {
//    labels: [
//        "Jan",
//        "Feb",
//        "Mar",
//        "Apr",
//        "Mei",
//        "Jun",
//        "Jul",
//        "Agu",
//        "Sep",
//        "Okt",
//        "Nov",
//        "Des",
//    ],
//    datasets: [
//        {
//            label: "Pengeluaran Perusahaan (Jutaan Rupiah)",
//            data: [12, 15, 14, 18, 20, 22, 24, 28, 25, 30, 32, 35], // Data pengeluaran contoh
//            backgroundColor: "rgba(255, 99, 132, 0.2)",
//            borderColor: "rgba(255, 99, 132, 1)",
//            borderWidth: 1,
//        },
//    ],
//};
// @AR, end

// Konfigurasi grafik profit
// @AR, start
//const profitConfig = {
//    type: "line", // Anda bisa mengganti dengan 'bar', 'pie', 'doughnut', dll.
//    data: profitData,
//    options: {
//        responsive: true,
//        scales: {
//            y: {
//                beginAtZero: true,
//            },
//        },
//    },
//};
// @AR, end

// Konfigurasi grafik pengeluaran
// @AR, start
//const expenditureConfig = {
//    type: "bar", // Anda bisa mengganti dengan 'line', 'pie', 'doughnut', dll.
//    data: expenditureData,
//    options: {
//        responsive: true,
//        scales: {
//            y: {
//                beginAtZero: true,
//            },
//        },
//    },
//};
// @AR, end

// Membuat dan menampilkan grafik profit
// @AR, start
//const ctxProfit = document.getElementById("profitChart").getContext("2d");
//const profitChart = new Chart(ctxProfit, profitConfig);
// @AR, end

// Membuat dan menampilkan grafik pengeluaran
// @AR, start
//const ctxExpenditure = document
//    .getElementById("expenditureChart")
//    .getContext("2d");
//const expenditureChart = new Chart(ctxExpenditure, expenditureConfig);
// @AR, end
