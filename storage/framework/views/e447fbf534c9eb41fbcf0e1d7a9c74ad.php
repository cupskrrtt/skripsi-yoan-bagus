

<?php $__env->startSection('container'); ?>
<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>  

    <title>Dashboard Penjualan</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    
    <style>
        .table-container {
            width: 100%; /* Menyesuaikan lebar tabel */
            border-radius: 10px;
        }
        .container {
            background-color: white;
            border-radius: 10px;
        }
        .chart-container{
            background-color: white;
            border-radius: 10px;
        }
    </style>

    <!-- @AR, start -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <div class="col">
            <div class="header-title">
                <h3>Selling (Aug 2024)</h3>
            </div>
                <div class="container">
                <table id="selling-report-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Period</th>
                            <th scope="col">Total Selling</th>
                            <th scope="col">Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="header-title">
                <h3>Purchases (Aug 2024)</h3>
            </div>
            <div class="container">
                <table id="purchase-report-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Period</th>
                            <th scope="col">Total Purchase</th>
                            <th scope="col">Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
    <div class="row row-cols-3 row-cols-md-2 g-3">
        <div class="col">
            <div class="header-title">
                <h3>Machines</h3>
            </div>
            <div class="container">
                <table id="machine-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Use</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="header-title">
                <h3>Workforce</h3>
            </div>
            <div class="container">
                <table id="workforce-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
    <!-- <div class="row row-cols-3 row-cols-md-4 g-3">
        <div class="col">
            <div class="container">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah Pesanan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="sales-table-body"> -->
                            <!-- Data dari database akan dimasukkan di sini -->
    <!--
                        </tbody>
                    </table>             
                </div>
                </div>
                <div class="col">
                <div class="container">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pesanan</th>
                                <th>Jumlah Penjualan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="order-table-body"> -->
                            <!-- Data dari database akan dimasukkan di sini -->
    <!--
                        </tbody>
                    </table>
                </div> 
                </div>
        <div class="col">
            <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mesin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="machine-table-body"> -->
                            <!-- Data dari database akan dimasukkan di sini -->
    <!--
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="col">
            <div class="container">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
        <div class="row row-cols-md-3 g-3">
            <div class="col">
                <div class="container">
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="container">
                <canvas id="profitChart"></canvas>
                </div>
            </div>
            <div class="col">
                <div class="container">
                <canvas id="expenditureChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="container">
                </div>
            </div>
        </div>
        -->
    <div class="row row-cols-md-2">
        <div class="col">
            <div class="header-title">
                <h3>Selling History (All-Time)</h3>
            </div>
            <div class="container">
                <canvas id="sales-chart"></canvas>
            </div>
        </div>
        <div class="col">
            <div class="header-title">
                <h3>Profit (2024)</h3>
            </div>
            <div class="container">
                <canvas id="profitChart"></canvas>
            </div>
        </div>
        <!--<div class="col">
            <h3>Expenditure (2024)</h3>
            <div class="container">
                <canvas id="expenditureChart"></canvas>
            </div>
        </div>-->
    </div>
    <br />
    <div class="row row-cols-md-2">
        <div class="col">
            <div class="header-title">
                <h3>Expenditure (2024)</h3>
            </div>
            <div class="container">
                <canvas id="expenditureChart"></canvas>
            </div>
        </div>
        <div class="col">
            <section class="timeline-container">
            <div class="timeline-header">
                <h3>Schedule - Timeline</h3>
                <div>
                    <a href="/project"><button class="btn btn-primary">Project View</button></a>
                    <select class="btn btn-light" id="monthSelect">
                        <option value="0">January</option>
                        <option value="1">February</option>
                        <option value="2">March</option>
                        <option value="3">April</option>
                        <option value="4">May</option>
                        <option value="5">June</option>
                        <option value="6">July</option>
                        <option value="7">August</option>
                        <option value="8">September</option>
                        <option value="9">October</option>
                        <option value="10">November</option>
                        <option value="11">December</option>
                    </select>
                    <button class="btn btn-success" id="addNewButton" onclick="location.href='project'">Add New</button>
                </div>
            </div>
            <div id="calendar">
                
            </div>
        </section>
        </div>
    </div>

    

    <!-- Modal -->
    
    <!-- @AR, end -->
</div>
<!-- @AR, start -->
<!--  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- @AR, end -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/js/dashboard.js"></script>
  
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', ['pagetitle'=>'Dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RYZEN\OneDrive\Documents\ta\TA-2 @AR2 20241016\resources\views/dashboard.blade.php ENDPATH**/ ?>