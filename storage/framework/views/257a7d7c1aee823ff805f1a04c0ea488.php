<?php $__env->startSection('container'); ?>

<div class="container-cs">
    <div class="top-bar">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Customer</h2>
            </div>
            <div class="dropdown-top">
                <a href="/customer">Customer</a> |
                <a href="/workforce">Workforce</a>
            </div>
            <div class="user-info">
                <img src="image2.jpg" alt="">
            </div>
        </div>
    </div>  


<section class="form">
  <?php echo csrf_field(); ?>
    <div class="row g-3 mb-3">
        <div class="col-new">
            <input id="ID" type="text" class="form-control" placeholder="New Customer" aria-label="ID" readonly>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="">Customer Name</label>
            <input id="Name" type="text" class="form-control" placeholder="Customer Name" aria-label="Nama">
        </div>
    </div>

    <div class="row g-3">
        <div class="col">
            <label for="">Class</label>
        <select id="Class" class="form-select mb-3" aria-label="Default select example">
            <option selected hidden>Class</option>
            <?php $__currentLoopData = $customerclasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col">
            <label for="">No. Telp</label>
            <input id="Telp" type="text" class="form-control" placeholder="08xx-xxxx-xxxx" aria-label="Telp">
        </div>
    </div>

<div>
    <button type="button" id="create-button" class="btn btn-primary">Create</button>
    <button type="button" id="update-button" class="btn btn-success">Update</button>
    <button type="button" id="delete-button" class="btn btn-danger">Delete</button>
    <button type="button" onclick="clearForm()" class="btn btn-secondary">Clear Form</button>
</div>

</section>

<section class="home-tbl">
    <table id="customer-table" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Golongan</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</section>

<script src="/js/customerScript.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cup/personal/dev/projects/skripsi-yoan-bagus/resources/views/customer.blade.php ENDPATH**/ ?>