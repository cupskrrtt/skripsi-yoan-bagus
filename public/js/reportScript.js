// @AR, start

// TO DO: format angka profitnya
function loadAllTimeProfitTable() {
    const profitDataTable = [];
    var profitDataTableIndex = 0;
    var profitDataTableNewIndex = 0;
    var tmpDate;
    
    $.ajax({
        url: '/api/profitReportView/',
        type: 'GET',
        success: function (data) {
            //console.log("API Response:", data); // Log the JSON data

            data.profitReportView.forEach((profitReportViewItem, profitReportViewIndex) => {
                // cari period yang sama di profitDataTable
                profitDataTableIndex = profitDataTable.findIndex(item => item.period === profitReportViewItem.period);

                if (profitDataTableIndex == -1) {
                    // ga ada period yang sama -> tambah item baru ke profitDataTable
                    profitDataTableNewIndex = profitDataTable.push(profitReportViewItem) - 1;

                    profitDataTable[profitDataTableNewIndex].action = 'profit';
                    profitDataTable[profitDataTableNewIndex].amount = parseFloat(profitDataTable[profitDataTableNewIndex].amount);

                    // buat object date dari period -- tanggalnya ga ngaruh
                    tmpDate =
                        new Date(parseInt(profitReportViewItem.period.toString().substring(0, 4)),
                            parseInt(profitReportViewItem.period.toString().substring(4, 6) - 1),
                            1
                        );

                    // ambil nama bulan (full) + tahun ke kolom full_period
                    profitDataTable[profitDataTableNewIndex].full_period =
                        tmpDate.toLocaleString('default', { month: 'long' }) + " " + tmpDate.getFullYear().toString();
                }
                else {
                    // ada period yang sama -> jumlahkan kolom amount
                    profitDataTable[profitDataTableIndex].amount += parseFloat(profitReportViewItem.amount);
                }
            });

            // taro data ke table
            $("#all-time-profit-report-table").DataTable({
                data: profitDataTable,
                columns:[
                            { data: 'full_period' },
                            {
                                data: "amount",
                                render: function (data, type, row) {
                                    return data
                                        .toString()
                                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                },
                            }
                        ]
            });
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

function loadAllTimeExpenditurePerMaterialTable() {
    $.ajax({
        url: '/api/expenditurePerMaterialReportView/',
        type: 'GET',
        success: function (allData) {
            //console.log("API Response:", allData); // Log the JSON data

            // taro data ke table
            $("#all-time-expenditure-per-material-report-table").DataTable({
                data: allData.expenditurePerMaterialReportView,
                columns:[
                            { data: 'purchase_period2' },
                            { data: 'name' },
                            {
                                data: "amount",
                                render: function (data, type, row) {
                                    return data
                                        .toString()
                                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                },
                            }
                        ]
            });
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

$(document).ready(function() {
    loadAllTimeProfitTable();
    loadAllTimeExpenditurePerMaterialTable();
});
// @AR, end
