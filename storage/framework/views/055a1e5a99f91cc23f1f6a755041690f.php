

<?php $__env->startSection('container'); ?>


<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Transaction</h2>
        </div>
        <div class="dropdown-top">
            <a href="/selling">Selling</a>
            <a href="">|</a>
            <a href="/selling/transaction" class="active">Transaction</a>
            <a href="">|</a>
            <a href="/selling/item">Item</a>
        </div>
        <div class="user-info">
            <img src="../image2.jpg" alt="">
        </div>
        </div>
    </div>


<section class="form">
  <?php echo csrf_field(); ?>
    <div class="row g-3 mb-3">
        <div class="col-new">
            <input id="ID" type="text" class="form-control" placeholder="Transaction" aria-label="ID" readonly>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="customerName">Customer</label>
            <select name="name" id="customerName" class="form-control" aria-label="Customer Name">
                <option selected hidden>Select a customer</option>
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($customer->id); ?>" data-discount="<?php echo e($customer->customerclass->discount); ?>">
                    <?php echo e($customer->name); ?> (<?php echo e($customer->customerclass->discount); ?>%)
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </select>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col">
            <label for="" class="form-label">Total</label>
            <input id="totalPrice" type="text" class="form-control" placeholder="Total" readonly>
        </div>
        <div class="col">
            <label for="" class="form-label">Paid</label>
            <input id="paid" type="text" class="form-control" placeholder="Paid">
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label for="">Payment</label>
            <select id="Payment" class="form-select mb-3" aria-label="Default select example">
                <option selected hidden>Payment</option>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($payment->id); ?>"><?php echo e($payment->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

<!-- @AR, start -->
<!-- <button type="button" id="detail-product" class="btn btn-info mb-3">Detail Product</button> -->
<button type="button" id="detail-product" class="btn btn-info mb-3">Detail Transaction</button>
<!-- @AR, end -->


<div class="modal fade mb-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Choose Product</h1>
                <button type="button" onclick="revertModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <!-- Selected Transaction Section -->
                    <div class="flex-fill me-3">
                        <h3>Selected Transaction</h3>
                        <table id="selectedTransactionTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">After Discount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="selectedTransactionBody">
                                <!-- Selected materials will be dynamically added here -->
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <h3>Total HTM: <span id="totalHTM">0</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="revertModal()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="closeModal();selectedModal();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div>
    <button type="button" id="update-button" class="btn btn-success">Update</button>
    <button type="button" id="delete-button" class="btn btn-danger">Delete</button>
    <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear Form</button>
</div>

</section>

<div class="filter-container">
    <label for="">Position:
    <select id="position-filter">
        <option value="">All</option>
        <option value="">Potong</option>
        <option value="">Setrika</option>
        <option value="">Jahit</option>
    </select>
    </label>
    <label for="">Status:
    <select id="status-filter">
        <option value="">All</option>
        <option value="">Masuk</option>
        <option value="">Izin</option>
        <option value="">Sakit</option>
        <option value="">Bolos</option>
    </select>
    </label>
</div>

<section class="home-tbl">
    <table id="transaction-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Paid</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Product</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>
<script src="/js/sellingTransaction.js"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel2.0\TA-2\resources\views/sellingtransaction.blade.php ENDPATH**/ ?>