

<?php $__env->startSection('container'); ?>

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Utility Page</h2>
            </div>
            <div class="dropdown-top"></div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>  

    <!-- @Utility, start -->
    <div class="row row-cols-2 row-cols-md-2 g-3">
        <div class="col">
            <h3>Machine</h3>
            <div class="container">
                <table id="machine-utility-table" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Machine</th>
                            <th scope="col">Date</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data from the database will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <h3>Employee</h3>
            <div class="container">
                <table id="employee-utility-table"  class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data from the database will be inserted here -->
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
                <form id="reportForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="project">ID Project</label>
                        <input type="text" class="form-control" id="idProject" required>
                    </div>
                    <div class="mb-3">
                        <label for="product">Product</label>
                        <input type="text" class="form-control" id="product" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Description</label>
                        <textarea class="form-control" id="description" rows="2" required></textarea>
                    </div>    
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col">
            <h3>Utility Table</h3>
            <div class="container">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">ID Project</th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <!-- Data dari AJAX akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/js/utilityScript.js"></script>
    <!-- @Utility, end -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\yoandhika\OneDrive\Documents\TA\TA-2\resources\views/utility.blade.php ENDPATH**/ ?>