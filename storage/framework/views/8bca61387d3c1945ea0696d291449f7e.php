

<?php $__env->startSection('container'); ?>

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Report Page</h2>
        </div>
        <div class="dropdown-top">
            <a href="/cash">Cash Book</a>
            <a href="">|</a>
            <a href="/report" class="active">Report</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<!-- @AR, start -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <div class="col">
            <h3>Profit (All-Time)</h3>
            <div class="container">
                <table id="all-time-profit-report-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Period</th>
                            <th scope="col">Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari database akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <h3>Expenditure (All-Time)</h3>
            <div class="container">
                <table id="all-time-expenditure-per-material-report-table"  class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Period</th>
                            <th scope="col">Material</th>
                            <th scope="col">Expenditure</th>
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
            <h3>Report</h3>
            <div class="container">
                <div class="mb-3">
                    <label for="ID_employee">ID Employee:</label>
                    <input type="text" class="form-control" id="ID_employee" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal">tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" required>
                </div>
                <div class="mb-3">
                    <label for="project">ID project</label>
                    <input type="text" class="form-control" id="project" required>
                </div>
                <div class="mb-3">
                    <label for="product">product</label>
                    <input type="text" class="form-control" id="product" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi">description</label>
                    <textarea class="form-control" id="deskripsi" rows="2" required></textarea>
                </div>    
                <button type="button" id="submit" class="btn btn-primary">submit</button>
            </div>
        </div>
            <div class="col">
                <h3>Report Table</h3>
                <div class="container">
                    <table id="report-employee-table" class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Employee</th>
                                <th scope="col">ID Project</th>
                                <th scope="col">Date</th>
                                <th scope="col">Product</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
    </div>

<script src="/js/reportScript.js"></script>
<!-- @AR, end -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\yoandhika\OneDrive\Documents\TA\TA-2\resources\views/report.blade.php ENDPATH**/ ?>