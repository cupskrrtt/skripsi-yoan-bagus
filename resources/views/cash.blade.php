@extends('layouts/main')

@section('container')

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Cash Book Page</h2>
        </div>
        <div class="dropdown-top">
            <a href="/cash" class="active">Cash Book</a>
            <a href="">|</a>
            <a href="/report">Report</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Mitra Produksi</h4>
                <p>Cash Book</p>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped table-hover" id="table_id">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th data-priority="2">Company</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Motiur Rahaman</td>
                            <td>017178499**</td>
                            <td>memotiur@gmail.com</td>
                            <td>PixonLab</td>
                            <td>Concord Regency, Panthapath, Dhaka</td>
                        </tr>


                        <tr>
                            <td>2</td>
                            <td>kunde.else</td>
                            <td>+1.768.717.1544</td>
                            <td>lehner.sonny@hotmail.com</td>
                            <td>Muller, Stanton and Zieme</td>
                            <td>43712 Quigley Street Apt. 869 South Taurean, NM 22014</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>ycormier</td>
                            <td>228.870.5976 x74536</td>
                            <td>crystel.ruecker@hotmail.com</td>
                            <td>Sawayn Group</td>
                            <td>28263 Liliane Island South Walkerborough, WI 77858-4350</td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

</section>

<style>
body {
            /* background-color: #F1F4F5; */
        }
        .card {
            margin: 0 1rem ;
        }
</style>

<script>
    $(document).ready(function() {
    $('#table_id').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        pageLength: 25,
        buttons: [
            'copy', 'csv', 'excel', {
                extend: 'pdf',
                text: 'Export PDF',
                title: 'Cash Book',
                customize: function(doc) {
                    var imgData = 'data:image/png;base64,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'; 
                    var now = new Date();
                    var date = now.toLocaleDateString('en-US', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });
                    var time = now.toLocaleTimeString('en-US', {
                        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true
                    });
                    
                     // Header with logo, title, and date
                     doc.content.unshift({
                        columns: [
                            {
                                // Logo column
                                image: imgData,
                                width: 50,
                                margin: [0, 0, 10, 0]
                            },
                            {
                                // Text column for title
                                text: 'Mitra Produksi',
                                fontSize: 15,
                                alignment: 'left',
                                bold: true,
                                margin: [10, 15, 0, 0]
                            },
                            {
                                 // Text column for title, date, and time
                                 text: [
                                    { text: '' + date, fontSize: 12 },
                                    { text: '\n ' + time, fontSize: 12 }
                                ],
                                alignment: 'right',
                                bold: true,
                                margin: [0, 15, 0, 0]
                            }
                        ]
                    });

                    // Adjust page margins to ensure content doesn't overlap with the header
                    doc.pageMargins = [30, 30, 30, 30]; // [left, top, right, bottom]
                }
            },
            'print'
        ]
    });
});



</script>

</div>
@endsection

